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
use Illuminate\Support\Facades\Log;
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
    if ($posts->isEmpty()) {
        $posts = null;
    }
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
    $images = [];
    return view('admin.post.create', ['categories' => $categories, 'sections' => $sections, 'images' => $images]);
}

    // FUNCTION TO CONVERT IMAGE
    private function convertImage($image)
    {
        $fileName = uniqid() . '.webp';
        $imagePath = 'uploads/' . $fileName;
   
        try {
            $img = Image::make($image->getRealPath());
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
            $image_name = hexdec(uniqid()) . '-' . time() . '.' . $ext;
            $imagePath = 'uploads/' . $image_name;
   
            try {
                $image_convert = Image::make($image->getRealPath());
                Storage::disk('local')->put($imagePath, (string) $image_convert->encode($ext, 50));
   
                $news[] = $imagePath;
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

    $messages = [
        'image.*.max' => 'Image size cannot exceed 6MB. Please upload a smaller image.',
        'image.*.mimes' => 'Only jpeg, png, jpg, and gif images are allowed.',
        'image.*.image' => 'The uploaded file must be an image.'
    ];

    $this->validate($request, [
        'title' => 'required',
        'description' => 'required',
        'content' => 'required',
        'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:6000', 
        'categories' => 'required',
        'sections' => 'sometimes',
        'reporter_name' => 'nullable',
    ]);


    try {
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->tags = $this->processTags($request->tags);
        $post->slug = Str::slug(substr($request->title, 0, 500));

        if ($request->hasFile('image')) {
            $uploadedImages = [];
            foreach ($request->file('image') as $file) {
                $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/post'), $imageName);
                $uploadedImages[] = $imageName;
            }
            $post->image = implode(',', $uploadedImages);
        }

        $post->reporter_name = $request->reporter_name;
        $post->save();
        $post->getCategories()->sync($request->categories);
        $post->getSections()->sync($request->sections);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    } catch (Exception $e) {
        return redirect()->back()->withInput()->with('errorMessage', 'Error creating post: ' . $e->getMessage());
    }
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
        $images = explode(',', $post->image);
        $categories = Category::all();
        $sections = Section::all();
        return view('admin.post.update', ['post' => $post, 'categories' => $categories, 'sections' => $sections, 'images' => $images]);
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
    // Validate input
    $messages = [
        'image.*.max' => 'Image size cannot exceed 6MB. Please upload a smaller image.',
        'image.*.mimes' => 'Only jpeg, png, jpg, and gif images are allowed.',
        'image.*.image' => 'The uploaded file must be an image.'
    ];

    $this->validate($request, [
        'id' => 'required|exists:posts,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'content' => 'required|string',
        'image.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:6000',
        'categories' => 'required|array',
        'categories.*' => 'exists:categories,id',
        'sections' => 'sometimes|array',
        'sections.*' => 'exists:sections,id',
        'reporter_name' => 'nullable|string|max:255',
        'tags' => 'nullable|string',
    ], $messages);

    try {
        // Find the post
        $post = Post::findOrFail($request->id);

        // Process tags
        $tags = $this->processTags($request->tags);

        // Handle content
        $content = $request->content;

        // 1. Handle existing images
        $existingImages = $request->input('existing_images', []);
        $removedImages = $request->input('removed_images', []);
        
        // Remove specified images
        foreach ($removedImages as $imageToRemove) {
            // Remove from existing images array
            $existingImages = array_filter($existingImages, function($image) use ($imageToRemove) {
                return trim($image) !== trim($imageToRemove);
            });
            
            // Delete the physical file
            $this->deleteImageFromStorage($imageToRemove, 'post');
        }

        // 2. Handle new image uploads
        $newImages = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imageName = $this->handleImageUpload($file, 'post');
                if ($imageName) {
                    $newImages[] = $imageName;
                }
            }
        }

        // 3. Combine existing and new images
        $allImages = array_merge($existingImages, $newImages);

        // 4. Extract images from content
        $contentImages = $this->extractContentImages($content);
        $allImages = array_merge($allImages, $contentImages);

        // Remove duplicates while preserving order
        $allImages = array_values(array_unique($allImages));

        // Update post attributes
        $post->fill([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $content,
            'tags' => $tags,
            'slug' => Str::slug(substr($request->title, 0, 500)),
            'reporter_name' => $request->reporter_name,
            'image' => $allImages ? implode(',', $allImages) : null
        ]);

        // Save the post
        if ($post->save()) {
            // Sync categories and sections
            $post->getCategories()->sync($request->categories);
            $post->getSections()->sync($request->sections ?? []);

            return redirect()->route('admin.posts.index')
                ->with('successMessage', 'Post updated successfully!');
        }

        // If save fails
        return redirect()->back()
            ->withInput()
            ->with('errorMessage', 'Failed to update post.');

    } catch (Exception $e) {
        // Log the error
        Log::error('Post Update Error: ' . $e->getMessage());

        // Return with error message
        return redirect()->back()
            ->withInput()
            ->with('errorMessage', 'An error occurred: ' . $e->getMessage());
    }
}

    /**
     * Handle image upload
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $subdirectory
     * @return string|null
     */
    private function handleImageUpload($file, $subdirectory = 'post')
{
    try {
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path("uploads/{$subdirectory}"), $imageName);
        return $imageName;
    } catch (\Exception $e) {
        Log::error('Image upload failed: ' . $e->getMessage());
        return null;
    }
}

private function deleteImageFromStorage($imageName, $subdirectory = 'post')
{
    $fullPath = public_path("uploads/{$subdirectory}/" . basename($imageName));
    if (file_exists($fullPath)) {
        try {
            unlink($fullPath);
        } catch (\Exception $e) {
            Log::error('Failed to delete image: ' . $e->getMessage());
        }
    }
}

private function extractContentImages($content)
{
    $contentImages = [];
    
    // Use regex to find all image sources in the content
    preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);
    
    if (!empty($matches[1])) {
        foreach ($matches[1] as $imageSrc) {
            // Extract just the filename from the full path
            $filename = basename($imageSrc);
            $contentImages[] = $filename;
        }
    }
    
    return $contentImages;
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
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:6000',
        ]);

        $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(public_path('uploads/post'), $fileName);

        return response()->json(['location' => asset('uploads/post/' . $fileName)]);
    }
}









