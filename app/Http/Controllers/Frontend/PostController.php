<?php

namespace App\Http\Controllers\Frontend;

use App\Cat;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Post;

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

    public function search_title(SearchRequest $request)
    {
        $q = $request->input('q');

        $posts = Post::with('cat', 'user', 'photo')
            ->where('status', 1)
            ->where('title', 'like', '%' . $q . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        $categories = Cat::all();
        return view('frontend.posts.search', compact(['posts', 'categories', 'q']));
    }
}
