<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NormalUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->is_normal_user()) {
                if ($request->id == Auth::user()->id) {
                    return $next($request);
                }
                return back();
            }
        }

        Session::flash('auth_error', 'You must be logged in before this request');
        return route('login');

    }
}
