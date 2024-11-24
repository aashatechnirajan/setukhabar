<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Display;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\UtilityFunctions;

class DisplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission','view_displays'),403);

        $displays = Display::with('getAds')->latest()->paginate(50);

        return view('admin.display.index', ['displays' => $displays]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission','create_displays'),403);

        return view('admin.display.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','create_displays'),403);

        $this->validate($request, [
            'title' => 'required',
        ]);
        try {
            $display = new Display;
            $display->title = $request->title;
            if ($display->save()) {
                UtilityFunctions::createHistory('Created Display with Id ' . $display->id . ' and title ' . $display->title, 1);
                return redirect()->route('admin.displays.index')->with(['successMessage' => 'Success !! Display created']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Display not created']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $display
     * @return \Illuminate\Http\Response
     */
    public function show(Display $display)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $display
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission','update_displays'),403);

        $display = Display::find($id);
        return view('admin.display.update', ['display' => $display]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $display
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','update_displays'),403);

        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
        ]);
        try {
            $display = Display::find($request->id);
            $display->title = $request->title;
            if ($display->save()) {
                UtilityFunctions::createHistory('Updated Display with Id ' . $display->id . ' and title ' . $display->title, 1);
                return redirect()->route('admin.displays.index')->with(['successMessage' => 'Success !! Display Updated']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Display not updated']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $display
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission','delete_displays'),403);

        try {
            $display = Display::find($id);
            if ($display->delete()) {
                $display->getAds()->detach();
                UtilityFunctions::createHistory('Deleted Display with Id ' . $display->id . ' and title ' . $display->title, 1);
                return redirect()->route('admin.displays.index')->with(['successMessage' => 'Success !! Display Deleted']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Display not Deleted']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }
}
