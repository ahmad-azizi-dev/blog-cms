<?php

namespace App\Http\Controllers\Frontend;

use App\Cat;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        $post = Post::with('user', 'photo', 'cat')
            ->where('slug', $slug)
            ->where('status', 1)->first();
        $categories = Cat::all();

        return (view('frontend.posts.show', compact(['post', 'categories'])));
    }
}
