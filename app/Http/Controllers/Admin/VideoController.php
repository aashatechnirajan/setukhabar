<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UtilityFunctions;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission','view_videos'),403);

        $videos = Video::latest()->paginate(50);
        return view('admin.videos.index', ['videos' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission','create_videos'),403);

        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','create_videos'),403);

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'slug' => 'required',
            'url' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
        try {
            $imagePath = time() . "-" . $request->title . "-" . $request->image->extension();
            $request->image->move(public_path('uploads/images/videos'), $imagePath);
            $video = new Video;
            $video->title = $request->title;
            $video->description = $request->description;
            $video->slug = $request->slug;
            $video->url = $request->url;
            $video->image = $imagePath;
            if ($video->save()) {
                UtilityFunctions::createHistory('Created Video with Id ' . $video->id . ' and title ' . $video->title, 1);
                return redirect()->route('admin.videos.index')->with(['successMessage' => 'Success !! Video created']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Video not created']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission','update_videos'),403);

        $video = Video::find($id);
        return view('admin.videos.update', ['video' => $video]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','update_videos'),403);

        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
            'url' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
        ]);
        try {
            $video = Video::find($request->id);
            if ($request->hasFile('image')) {
                $imagePath = time() . "-" . $request->title . "-" . $request->image->extension();
                $request->image->move(public_path('uploads/images/video'), $imagePath);
                Storage::delete('public/' . $video->image);
                $video->image = $imagePath;
            }

            $video->title = $request->title;
            $video->description = $request->description;
            $video->slug = $request->slug;
            $video->url = $request->url;
            if ($video->save()) {
                UtilityFunctions::createHistory('Updated Video with Id ' . $video->id . ' and title ' . $video->title, 1);
                return redirect()->route('admin.videos.index')->with(['successMessage' => 'Success !! Video Updated']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Video not updated']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission','delete_videos'),403);

        try {
            $video = Video::find($id);
            if ($video->delete()) {
                Storage::delete('public/'.$video->image);
                UtilityFunctions::createHistory('Deleted Video with Id ' . $video->id . ' and title ' . $video->title, 1);
                return redirect()->route('admin.videos.index')->with(['successMessage' => 'Success !! Video Deleted']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Video not Deleted']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }
}
