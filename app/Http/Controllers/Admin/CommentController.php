<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        //ACL Users
        $this->middleware('can:show-comments')->only(['index']);
        $this->middleware('can:unapproved-comments')->only(['unapproved']);
        $this->middleware('can:edit-comment')->only(['update', 'edit']);
        $this->middleware('can:delete-comment')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::query();
        if ($keyword = \request('search')) {
            $comments = $comments->where('comment', 'LIKE', "%{$keyword}%")
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                });
        }
        $comments = $comments->whereApproved(1)->latest()->paginate(6);
        return view('Admin.Comments.all', compact('comments'));
    }

    public function unapproved()
    {
        $comments = Comment::query();
        if ($keyword = \request('search')) {
            $comments = $comments->where('comment', 'LIKE', "%{$keyword}%")
                ->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            });
        }
        $comments = $comments->whereApproved(0)->latest()->paginate(20);
        return view('Admin.Comments.unapproved', compact('comments'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //alert update
        return view('Admin.Comments.edit', compact('comment'));

    }

    public function update(Comment $comment, Request $request)
    {
        $comment->update(['approved' => 1, 'comment' => $request->comment]);
        //alert update
        return redirect(route('admin.comments.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        //alert delete
        alert()->success('Delete');
        return back();

    }
}
