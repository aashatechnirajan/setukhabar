<?php

namespace App\Http\Controllers\Admin;

use File;
use Exception;
use App\Models\Ad;
use Carbon\Carbon;
use App\Models\Display;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UtilityFunctions;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission', 'view_ads'), 403);
        $ads = Ad::with('getDisplays')->latest()->paginate(50);

        return view('admin.ads.index', ['ads' => $ads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission', 'create_ads'), 403);
        $displays = Display::all();

        return view('admin.ads.create', ['displays' => $displays]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'create_ads'), 403);
        $this->validate($request, [
            'title' => 'string',
            'url' => 'string',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg',
            'displays' => 'sometimes',
        ]);
        try {
            $imagePath = time() . "-" . $request->title . "-" . $request->image->extension();
            $request->image->move(public_path('uploads/images/ads'), $imagePath);
            $ad = new Ad;
            $ad->title = $request->title;
            $ad->url = $request->url;
            $ad->image = $imagePath;
            if ($ad->save()) {
                $ad->getDisplays()->sync($request->displays);
                UtilityFunctions::createHistory('Created Ad with Id ' . $ad->id . ' and title ' . $ad->title, 1);
                return redirect()->route('admin.ads.index')->with(['successMessage' => 'Success !! Ad created']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Ad not created']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission', 'update_ads'), 403);
        $ad = Ad::find($id);
        $displays = Display::all();
        return view('admin.ads.update', ['ad' => $ad, 'displays' => $displays]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'update_ads'), 403);
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
            'url' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
        ]);
        try {
            $ad = Ad::find($request->id);
            if ($request->hasFile('image')) {
                $imagePath = time() . "-" . $request->title . "-" . $request->image->extension();
                $request->image->move(public_path('uploads/images/ads'), $imagePath);
                Storage::delete('public/' . $ad->image);
                $ad->image = $imagePath;
            }

            $ad->title = $request->title;
            $ad->url = $request->url;
            if ($ad->save()) {
                $ad->getDisplays()->sync($request->displays);
                UtilityFunctions::createHistory('Updated Ad with Id ' . $ad->id . ' and title ' . $ad->title, 1);
                return redirect()->route('admin.ads.index')->with(['successMessage' => 'Success !! Ad Updated']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Ad not updated']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission', 'delete_ads'), 403);
        try {
            $ad = Ad::find($id);
            if ($ad->delete()) {
                $ad->getDisplays()->detach();


                // Storage::delete('public/' . $ad->image);
                Storage::delete('uploads/images/ads/' . $ad->image);
                UtilityFunctions::createHistory('Deleted Ad with Id ' . $ad->id . ' and title ' . $ad->title, 1);
                return redirect()->route('admin.ads.index')->with(['successMessage' => 'Success !! Ad Deleted']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Ad not Deleted']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }
}
