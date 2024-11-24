<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\ImageConverter;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $images = Gallery::paginate(50);
        return view(
            'admin.gallery.index',
            [
                'images' => $images,
                'page_title' => 'Image'
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.gallery.create', ['page_title' => 'Create Gallery']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'img_desc' => 'required|string|max:255',
            'img' => 'required|array',
            'img.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // maximum file size of 2 MB
        ]);
        $images = $request->file('img');
        $path = 'uploads/gallery/';
        $convertedImages = ImageConverter::convertImages($images, $path);

        $gallery = new Gallery;
        $gallery->img_desc = $request->img_desc;
        $gallery->img = $convertedImages;

        $gallery->save();


        return redirect('admin/galleries/index')->with(['successMessage' => 'Success! Gallery Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery, $id)
    {
        //
        $gallery = Gallery::find($id);
        return view(
            'admin.gallery.update',
            [
                'gallery' => $gallery,
                'page_title' => 'Update Gallery'
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'img_desc' => 'required|string|max:255',
            'img' => 'required|array',
            'img.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // maximum file size of 2 MB
        ]);

        // Fetch the gallery object using its ID
        $gallery = Gallery::findOrFail($request->id);

        $images = $request->file('img');
        $path = 'uploads/gallery/';
        $convertedImages = ImageConverter::convertImages($images, $path);

        $gallery->img_desc = $request->img_desc;

        if ($convertedImages) {
            $gallery->img = $convertedImages;
        }

        $gallery->save();


        return redirect('admin/galleries/index')->with(['successMessage' => 'Success! Gallery Updated']);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery, $id)
    {
        //
        $gallery = Gallery::find($id);

        $gallery->delete();

        return redirect('admin/galleries/index')->with(['successMessage' => 'Success !!Gallery Deleted']);
    }
}
