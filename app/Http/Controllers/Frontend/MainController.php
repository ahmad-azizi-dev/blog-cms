<?php

namespace App\Http\Controllers\Frontend;

use App\Cat;
use App\Events\VisitLogEvent;
use App\Http\Controllers\Controller;
use App\Position;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $paginate_per_page = 5;
        if ($PerPagePost = $request->input('PerPage')) {     //can get show per page options from a user that apply
            $paginate_per_page = $PerPagePost;
            session(['PerPagePost' => $PerPagePost]);
        } elseif ($PerPagePost = session('PerPagePost')) {  //get show per page options from session
            $paginate_per_page = $PerPagePost;
        } else {
            session(['PerPagePost' => $paginate_per_page]);
        }

        $posts = Post::with('cat', 'user', 'photo')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate($paginate_per_page);
        $categories = Cat::all();

        $ip = $request->ip();

        $visit = visitor()->visit();  // create a visit log
        $position = new Position();
        $position->ip = $visit->ip;
        $position->visit_id = $visit->id;
        $position->save(); //  other columns of saved positions table will be filled in the event queue
        event(new VisitLogEvent($position));  //Dispatching VisitLogEvent for filling other columns

        $location = Location::get($ip);

        $url = $request->url();
        if (Str::contains($url, ['localhost', 'azizi-dev']) == null) {  //check url just for test!!!
            return redirect('https://amir-azizi-dev.ir');
        }

        return view('frontend.main.index', compact(['posts', 'categories', 'location']));
    }
}
