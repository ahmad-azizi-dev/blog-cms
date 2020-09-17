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
        $post = Post::with(['user', 'photo', 'cat',
            'comments' => function ($q) {
                $q->where('status', '1')
                    ->where('parent_id', '0');
            }])
            ->where('slug', $slug)
            ->where('status', 1)->first();

        if (!$post) {
            abort(404);
        }

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

    public function category($slug)
    {
        $categories = Cat::all();
        $this_category = $categories->where('slug', $slug)->first();
        if (!$this_category) {
            abort(404);
        }

        $posts = Post::with('cat', 'user', 'photo')
            ->where('cat_id', $this_category->id)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('frontend.posts.category', compact(['posts', 'categories', 'this_category']));
    }
}
