<?php

namespace App\Http\Controllers;

use App\Models\Favicon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class FaviconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $icons = Favicon::all();
        return view('admin.favicon.index', [
            'icons' => $icons,
            'page_title' => 'Favicons'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.favicon.create', [
            'page_title' => 'Favicons create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'favicon_thirtyTwo' => 'image|mimes:jpg,png,peg,gif,svg|max:2048',
            'favicon_sixteen' => 'image|mimes:jpg,png,peg,gif,svg|max:2048',
            'apple_touch_icon' => 'image|mimes:jpg,png,peg,gif,svg|max:2048',
            'file' => 'required|file|max:4000'

        ]);

        if ($request->hasFile('favicon_thirtyTwo')) {
            $favIconThirtyTwo = time() . '.' . $request->favicon_thirtyTwo->extension();

            // Create the directory if it doesn't exist
            $directory = public_path('uploads/favicon/');
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }
// move
            $request->favicon_thirtyTwo->save($directory, $favIconThirtyTwo);
        } else {
            $favIconThirtyTwo = "NoFile";
        }


        if ($request->hasFile('favicon_sixteen')) {
            $favIconSixteen = time() . '.' . $request->favicon_sixteen->extension();

            // Create the directory if it doesn't exit
            $directory = public_path('uploads/favicon/');
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            $request->favicon_sixteen->save($directory, $favIconSixteen);

        } else {
            $favIconSixteen = "NoFile";
        }


        if ($request->hasFile('apple_touch_icon')) {
            $AppleTouchIcon = time() . '.' . $request->apple_touch_icon->extension();

            // Create the directory if it doesn't exit
            $directory = public_path('uploads/favicon/');
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            $request->apple_touch_icon->save($directory, $AppleTouchIcon);

        } else {
            $AppleTouchIcon = "NoFile";
        }


        if ($request->hasFile('file')) {
            $postPath = time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads/favicon/file/'), $postPath);
        } else {
            $postPath = "NoFile";
        }

        $favicon = new Favicon;
        $favicon->favicon_thirtyTwo = $favIconThirtyTwo;
        $favicon->favicon_sixteen = $favIconSixteen;
        $favicon->apple_touch_icon = $AppleTouchIcon;
        $favicon->file = $postPath;
        $favicon->save();
        return redirect('admin/favicons/index')->with(['successMessage' => 'Success !! Favicon Created']);
        //        $file = $request->file('file');

    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favicon  $favicon
     * @return \Illuminate\Http\Response
     */
    public function show(Favicon $favicon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favicon  $favicon
     * @return \Illuminate\Http\Response
     */
    public function edit(Favicon $favicon, $id)
    {
        //

        $favicon = Favicon::find($id);
        return view('admin.favicon.update',[
            'favicon' => $favicon,
            'page_title' => 'Update favicon'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favicon  $favicon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favicon $favicon)
    {
        //


        $this->validate($request, [
            'favicon_thirtyTwo' => 'image|mimes:jpg,png,peg,gif,svg|max:2048',
            'favicon_sixteen' => 'image|mimes:jpg,png,peg,gif,svg|max:2048',
            'apple_touch_icon' => 'image|mimes:jpg,png,peg,gif,svg|max:2048',
            'file' => 'required|file|max:4000'

        ]);

        if ($request->hasFile('favicon_thirtyTwo')) {
            $favIconThirtyTwo = time() . '.' . $request->favicon_thirtyTwo->extension();
            $request->favicon_thirtyTwo->move(public_path('uploads/favicon/'), $favIconThirtyTwo);
        } else {
            $postPath = "NoFile";
        }

        if ($request->hasFile('favicon_sixteen')) {
            $favIconSixteen = time() . '.' . $request->favicon_sixteen->extension();
            $request->favicon_sixteen->move(public_path('uploads/favicon/'), $favIconSixteen);
        } else {
            $postPath = "NoFile";
        }

        if ($request->hasFile('apple_touch_icon')) {
            $AppleTouchIcon = time() . '.' . $request->apple_touch_icon->extension();
            $request->apple_touch_icon->move(public_path('uploads/favicon/'), $AppleTouchIcon);
        } else {
            $postPath = "NoFile";
        }





        if ($request->hasFile('file')) {
            $postPath = time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads/favicon/file/'), $postPath);
        } else {
            $postPath = "NoFile";
        }

        $favicon = Favicon::find($request->id);
        $favicon->favicon_thirtyTwo = $favIconThirtyTwo;
        $favicon->favicon_sixteen = $favIconSixteen;
        $favicon->apple_touch_icon = $AppleTouchIcon;
        $favicon->file = $postPath;
        $favicon->save();
        return redirect('admin/favicons/index')->with(['successMessage' => 'Success !! Favicon Created']);
        //        $file = $request->file('file');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favicon  $favicon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favicon $favicon, $id)
    {
        //
        //
        $icon = Favicon::find($id);
        $icon->delete();

        return redirect('admin/favicons/index')->with(['successMessage' => 'Success !! Favicon Deleted']);
    }
}
