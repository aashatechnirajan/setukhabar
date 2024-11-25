<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\UtilityFunctions;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission','view_categories'),403);
        $categories = Category::with('getPosts')->latest()->paginate(50);

        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission','create_categories'),403);

        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','create_categories'),403);

        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
        ]);
        try {
            $category = new Category;
            $category->title = $request->title;
            $category->slug = $request->slug;
            // $category->slug = SlugService::createSlug(Category::class,'slug', $request->title);
            if ($category->save()) {
                UtilityFunctions::createHistory('Created Category with Id ' . $category->id . ' and title ' . $category->title, 1);
                return redirect()->route('admin.categories.index')->with(['successMessage' => 'Success !! Category created']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Category not created']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission','update_categories'),403);

        $category = Category::find($id);
        return view('admin.category.update', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_unless(Gate::allows('hasPermission','update_categories'),403);

        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
            'slug' => 'required',
        ]);
        try {
            $category = Category::find($request->id);
            $category->title = $request->title;
            $category->slug = $request->slug;
            // $category->slug = SlugService::createSlug(Category::class,'slug', $request->title);
            if ($category->save()) {
                UtilityFunctions::createHistory('Updated Category with Id ' . $category->id . ' and title ' . $category->title, 1);
                return redirect()->route('admin.categories.index')->with(['successMessage' => 'Success !! Category Updated']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Category not updated']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission','delete_categories'),403);

        try {
            $category = Category::find($id);
            if ($category->delete()) {
                $category->getPosts()->detach();
                UtilityFunctions::createHistory('Deleted Category with Id ' . $category->id . ' and title ' . $category->title, 1);
                return redirect()->route('admin.categories.index')->with(['successMessage' => 'Success !! Category Deleted']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Category not Deleted']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }
}
