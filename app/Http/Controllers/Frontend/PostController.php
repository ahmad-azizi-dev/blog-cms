<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id)
    {
        $post=Post::with('user','photo','cat')->whereKey($id)->first();

        return(view('frontend.posts.show',compact('post')));
    }
}
