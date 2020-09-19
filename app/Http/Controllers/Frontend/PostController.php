<?php

namespace App\Http\Controllers\Frontend;

use App\Cat;
use App\Events\VisitLogEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Position;
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

        // $visitsCount = $post->visitLogs()->count();

        $visit = visitor()->visit($post);  // create a visit log for $post
        //$visit->ip = mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255); //for local check

        $position = new Position();
        $position->ip = $visit->ip;
        $position->visit_id = $visit->id;
        $position->save(); //  other columns of saved positions table will be filled in the event queue
        event(new VisitLogEvent($position));  //Dispatching VisitLogEvent for filling other columns


        $categories = Cat::all();

        return (view('frontend.posts.show', compact(['post', 'categories'])));
    }

    public function search_title(SearchRequest $request)
    {
        $visit = visitor()->visit();  // create a visit log
        $position = new Position();
        $position->ip = $visit->ip;
        $position->visit_id = $visit->id;
        $position->save(); //  other columns of saved positions table will be filled in the event queue
        event(new VisitLogEvent($position));  //Dispatching VisitLogEvent for filling other columns

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

        $visit = visitor()->visit($this_category);  // create a visit log for categories
        $position = new Position();
        $position->ip = $visit->ip;
        $position->visit_id = $visit->id;
        $position->save(); //  other columns of saved positions table will be filled in the event queue
        event(new VisitLogEvent($position));  //Dispatching VisitLogEvent for filling other columns


        $posts = Post::with('cat', 'user', 'photo')
            ->where('cat_id', $this_category->id)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('frontend.posts.category', compact(['posts', 'categories', 'this_category']));
    }
}
