<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UtilityFunctions;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission', 'view_site_settings'), 403);

        $sitesettings = SiteSetting::all();
        return view('admin.sitesetting.index', ['sitesettings' => $sitesettings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSetting $siteSetting, $id)
    {
        //
        $sitesetting = SiteSetting::find($id);
        return view('admin.sitesetting.update',[
            'sitesetting' => $sitesetting,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'update_site_settings'), 403);

        $request->validate([
            'title' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'location' => 'required',
            'facebook' => 'url|nullable',
            'linkedin' => 'url|nullable',
            'twitter' => 'url|nullable',
            'pinterest' => 'url|nullable',
            'main_logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:5120',
        ]);

        $siteSetting = SiteSetting::find(1);


        if ($request->hasFile('main_logo')) {
            $uploadedFile = $request->file('main_logo');

            $newMainLogo = time() . '-mainlogo' . $request->title . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('uploads/sitesetting/'), $newMainLogo);

            $siteSetting->main_logo = $newMainLogo;
        }


        $siteSetting->title = $request->title;
        $siteSetting->phone = $request->phone;
        $siteSetting->email = $request->email;
        $siteSetting->location = $request->location;
        $siteSetting->facebook = $request->facebook;
        $siteSetting->twitter = $request->twitter;
        $siteSetting->pinterest = $request->pinterest;

        $siteSetting->save();

        return redirect('admin/sitesettings/index')->with('success', 'Site settings updated successfully!');

    }
}
