<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UtilityFunctions;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission', 'view_comments'), 403);
        $comments = Comment::with('getUser', 'getPost')->where('user_id', Auth::id())->latest()->get();
        return view('admin.comment.index', ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission', 'create_comments'), 403);
        $bichaarsection = Section::where('title', 'विचार')->first();
        $posts = Post::whereHas('getSections', function ($q) use ($bichaarsection) {
            $q->where('section_id', $bichaarsection->id);
        })->latest()->get();
        return view('admin.comment.create', ['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'create_comments'), 403);

        $this->validate($request, [
            'comment' => 'required',
            'post_id' => 'required',
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
        try {
            $imagePath = $request->file('image')->storeAs('images/comment', Carbon::now() . str_replace('.', '-', $request->name) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
            $comment = new Comment;
            $comment->comment = $request->comment;
            $comment->name = $request->name;
            $comment->image = $imagePath;
            $comment->getUser()->associate(Auth::id());
            $comment->getPost()->associate($request->post_id);
            if ($comment->save()) {
                UtilityFunctions::createHistory('Created comment with id ' . $comment->id . ' name ' . $comment->name, 1);
                return redirect()->route('admin.comments.index')->with(['successMessage' => "Success !! Comment added"]);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error!! Comment not added']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('hasPermission', 'update_comments'), 403);

        $comment = Comment::with('getUser', 'getPost')->find($id);
        $post = Post::find($comment->getPost->id);
        return view('admin.comment.update', ['comment' => $comment, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'update_comments'), 403);

        $this->validate($request, [
            'id' => 'required',
            'comment' => 'required',
            // 'post_id' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
        ]);
        try {
            $comment = Comment::find($request->id);
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->storeAs('images/comment', Carbon::now() . str_replace('.', '-', $request->name) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
                Storage::delete('public/' . $comment->image);
                $comment->image = $imagePath;
            }
            $comment->comment = $request->comment;
            $comment->name = $request->name;
            // $comment->getUser->associate(Auth::id());
            // $comment->getPost->associate($request->post_id);
            if ($comment->save()) {
                UtilityFunctions::createHistory('Updated comment with id ' . $comment->id, 1);
                return redirect()->route('admin.comments.index')->with(['successMessage' => "Success !! Comment Updated"]);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error!! Comment not Updated']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission', 'delete_comments'), 403);

        try {
            $comment = Comment::find($id);
            if ($comment->delete()) {
                Storage::delete('public/' . $comment->image);
                UtilityFunctions::createHistory('Deleted Comment with id ' . $comment->id, 1);
                return redirect()->route('admin.comments.index')->with(['successMessage' => "Success !! Comment deleted"]);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error!! Comment not Deleted']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['errorMessage' => $e->getMessage()]);
        }
    }
}
