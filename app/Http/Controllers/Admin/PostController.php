<?php


namespace App\Http\Controllers\Admin;


use Exception;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UtilityFunctions;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission', 'view_posts'), 403);




        $posts = Post::with('getCategories', 'getSections')->latest()->paginate(20);


        return view('admin.post.index', ['posts' => $posts]);
    }








    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission', 'create_posts'), 403);


        $categories = Category::all();
        $sections = Section::all();
        return view('admin.post.create', ['categories' => $categories, 'sections' => $sections]);
    }


    // FUNCTION TO CONVERT IMAGE


    private function convertImage($image)
    {
        // Generate a unique file name
        $fileName = uniqid() . '.webp';
        $imagePath = 'uploads/' . $fileName; // Save inside storage/app/uploads
   
        try {
            // Use the Storage facade to store the image
            $img = Image::make($image->getRealPath());
            // Save the image in storage/app/uploads directory
            Storage::disk('local')->put($imagePath, (string) $img->encode('webp', 70));
   
            return $imagePath;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
   
    private function convertImages($images)
    {
        $ext = 'webp';
        $news = [];
   
        foreach ($images as $image) {
            // Generate a unique image name
            $image_name = hexdec(uniqid()) . '-' . time() . '.' . $ext;
            $imagePath = 'uploads/' . $image_name; // Save inside storage/app/uploads
   
            try {
                // Convert the image to the correct format and save it in the storage folder
                $image_convert = Image::make($image->getRealPath());
                Storage::disk('local')->put($imagePath, (string) $image_convert->encode($ext, 50));
   
                $news[] = $imagePath; // Store relative path for DB
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
   
        return $news;
    }
   
   
    private function processTags($tags)
    {
        if (empty($tags)) {
            return '';
        }


        $tagsArray = explode(',', $tags);
        $formattedTags = [];


        foreach ($tagsArray as $tag) {
            $formattedTags[] = '#' . trim($tag);
        }


        return implode(',', $formattedTags);
    }






    public function store(Request $request)
{
    abort_unless(Gate::allows('hasPermission', 'create_posts'), 403);

    $this->validate($request, [
        'title' => 'required',
        'description' => 'required',
        'content' => 'required',
        'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:6000', 
        'categories' => 'required',
        'sections' => 'sometimes',
        'reporter_name' => 'nullable',
    ]);

    try {
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;

        // Clean and assign content
        $content = $request->content;
        $strippedContent = preg_replace('/<(?!p\b)[^>]*>/', '', $content);
        $post->content = $strippedContent;

        // Process tags
        $post->tags = $this->processTags($request->tags);
        $post->slug = Str::slug(substr($request->title, 0, 500));

        // Process images
        $uploadedImages = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/post'), $imageName);
                $uploadedImages[] = 'uploads/post/' . $imageName;
            }
        }

        // Save the images as JSON in the `image` column
        $post->image = json_encode($uploadedImages);

        // Other fields
        $post->reporter_name = $request->reporter_name;

        // Save the post
        $post->save();

        // Sync categories and sections
        $post->getCategories()->sync($request->categories);
        $post->getSections()->sync($request->sections);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    } catch (Exception $e) {
        return redirect()->back()->withInput()->with('errorMessage', 'Error creating post: ' . $e->getMessage());
    }
}

   
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission', 'update_posts'), 403);


        $post = Post::find($id);
        $categories = Category::all();
        $sections = Section::all();
        return view('admin.post.update', ['post' => $post, 'categories' => $categories, 'sections' => $sections]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'update_posts'), 403);

        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:6000',
            'categories' => 'required',
            'repoter_name' => 'nullable',
        ]);

        try {
            $post = Post::find($request->id);
            
            // Process images
            if ($request->hasFile('image')) {
                $uploadedImages = [];
                foreach ($request->file('image') as $file) {
                    $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/post'), $imageName);
                    $uploadedImages[] = 'uploads/post/' . $imageName;
                }
                
                // Update the images array in the database
                $post->image = json_encode($uploadedImages);
            }

            $post->title = $request->title;
            $post->description = $request->description;
            $post->content = $request->content;
            $post->tags = $this->processTags($request->tags);
            $post->slug = Str::slug(substr($request->title, 0, 500));
            $post->reporter_name = $request->reporter_name;

            if ($post->save()) {
                $post->getCategories()->sync($request->categories);
                $post->getSections()->sync($request->sections);
                UtilityFunctions::createHistory('Updated Post with Id ' . $post->id . ' and title ' . $post->title, 1);
                return redirect()->route('admin.posts.index')->with(['successMessage' => 'Success!! Post Updated']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error!! Post not Updated']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission', 'delete_posts'), 403);


        try {
            $post = Post::find($id);
            if ($post->delete()) {


                $post->getCategories()->detach();
                $post->getSections()->detach();


                UtilityFunctions::createHistory('Deleted Ad with Id ' . $post->id . ' and title ' . $post->title, 1);
                return redirect()->route('admin.posts.index')->with(['successMessage' => 'Success !! Post Deleted']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Post not Deleted']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }


    public function uploadImage(Request $request)
    {






        $fileName = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs('uploads/tiny', $fileName, 'public');
        return response()->json(['location' => "/storage/$path"]);


        $imgpath = request()->file('file')->store('uploads/tiny/', 'public');
        return response()->json(['location' => "/storage/$imgpath"]);
    }
}



