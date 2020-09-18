<?php

namespace App\Http\Controllers\Frontend;

use App\Cat;
use App\Http\Controllers\Controller;
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
        //dd(Request::header('User-Agent'));

        $location = Location::get($ip);

        return view('frontend.main.index', compact(['posts', 'categories', 'location']));
    }
}
