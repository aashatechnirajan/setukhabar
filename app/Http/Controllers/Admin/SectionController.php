<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\UtilityFunctions;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission','view_sections'),403);

        $sections = Section::with('getPosts')->latest()->paginate(50);

        return view('admin.section.index', ['sections' => $sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission','create_sections'),403);

        return view('admin.section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','create_sections'),403);

        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
        ]);
        try {
            $section = new Section;
            $section->title = $request->title;
            $section->slug = $request->slug;
            if ($section->save()) {
                UtilityFunctions::createHistory('Created Section with Id ' . $section->id . ' and title ' . $section->title, 1);
                return redirect()->route('admin.sections.index')->with(['successMessage' => 'Success !! Section created']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Section not created']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $section
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission','update_sections'),403);

        $section = Section::find($id);
        return view('admin.section.update', ['section' => $section]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','update_sections'),403);

        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
            'slug' => 'required',
        ]);
        try {
            $section = Section::find($request->id);
            $section->title = $request->title;
            $section->slug = $request->slug;
            if ($section->save()) {
                UtilityFunctions::createHistory('Updated Section with Id ' . $section->id . ' and title ' . $section->title, 1);
                return redirect()->route('admin.sections.index')->with(['successMessage' => 'Success !! Section Updated']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Section not updated']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission','delete_sections'),403);

        try {
            $section = Section::find($id);
            if ($section->delete()) {
                $section->getPosts()->detach();
                UtilityFunctions::createHistory('Deleted Section with Id ' . $section->id . ' and title ' . $section->title, 1);
                return redirect()->route('admin.sections.index')->with(['successMessage' => 'Success !! Section Deleted']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Section not Deleted']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }
}
