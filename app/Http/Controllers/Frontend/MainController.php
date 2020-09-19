<?php

namespace App\Http\Controllers\Frontend;

use App\Cat;
use App\Events\VisitLogEvent;
use App\Http\Controllers\Controller;
use App\Position;
use App\Post;
use Illuminate\Support\Facades\Request;
use Stevebauman\Location\Facades\Location;

class MainController extends Controller
{
    public function index()
    {
        $posts = Post::with('cat', 'user', 'photo')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        $categories = Cat::all();

        $ip = Request::ip();

        $visit = visitor()->visit();  // create a visit log
        $position = new Position();
        $position->ip = $visit->ip;
        $position->visit_id = $visit->id;
        $position->save(); //  other columns of saved positions table will be filled in the event queue
        event(new VisitLogEvent($position));  //Dispatching VisitLogEvent for filling other columns

        $location = Location::get($ip);

        return view('frontend.main.index', compact(['posts', 'categories', 'location']));
    }
}
