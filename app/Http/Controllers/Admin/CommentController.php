<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        $all_id_comment = Comment::pluck('id')->toArray();
        // get all id of comments for checking parent is exist!

        return view('admin.comments.index', compact(['comments','all_id_comment']));
    }

    public function actions(Request $request, $id)
    {
        if ($request->has('action')) {
            if ($request->input('action') == 'approved') {
                $comment = Comment::findOrFail($id);
                $comment->status = 1;
                $comment->save();
                Session::flash('approved_comment', 'comment approved where id=' . $id);
            } else {
                $comment = Comment::findOrFail($id);
                $comment->status = 0;
                $comment->save();
                Session::flash('rejected_comment', 'comment rejected where id=' . $id);
            }
        }
        return redirect('/admin/comments');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.edit', compact(['comment']));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->description = $request->input('description');
        $comment->save();

        Session::flash('update_comment', 'comment updated successfully');
        return redirect('/admin/comments');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Session::flash('delete_comment', 'comment deleted successfully');

        return redirect('admin/comments');
    }
}
