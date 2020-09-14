<?php

namespace App\Http\Controllers\Frontend;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $postId)
    {
        if (Auth::id()) {
            $post = Post::findOrFail($postId);

            if ($post) {
                $comment = new Comment();
                $comment->description = $request->input('description');
                $comment->post_id = $post->id;
                $comment->user_id = Auth::id();
                $comment->status = 0;
                $comment->parent_id = 0;
                $comment->save();
            }
            Session::flash('add_comment', 'Your comment has been successfully submitted and is awaiting approval from managers');
            return back();

        } else {
            Session::flash('add_comment', 'You must be logged in to post a comment');
            return back();
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function reply(CommentRequest $request)
    {
        if (Auth::id()) {
            $postId = $request->input('post_id');
            $parentId = $request->input('parent_id');

            $post = Post::findOrFail($postId);
            if ($post) {
                $comment = new Comment();
                $comment->description = $request->input('description');
                $comment->parent_id = $parentId;
                $comment->post_id = $post->id;
                $comment->user_id = Auth::id();
                $comment->status = 0;
                $comment->save();
            }

            Session::flash('add_comment', 'Your comment has been successfully submitted and is awaiting approval from managers');
            return back();

        } else {
            Session::flash('add_comment', 'You must be logged in to post a comment');
            return back();
        }
    }
}
