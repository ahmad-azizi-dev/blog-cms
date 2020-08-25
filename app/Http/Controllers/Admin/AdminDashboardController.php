<?php

namespace App\Http\Controllers\Admin;

use App\Cat;
use App\Http\Controllers\Controller;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $post_count = Post::count();
        $user_count = User::count();
        $photo_count = Photo::count();
        $category_count = Cat::count();

        $posts = Post::orderBy('created_at', 'desc')->limit(5)->get();
        $users = User::orderBy('created_at', 'desc')->limit(5)->get();

        return (view('admin.dashboard.index', compact(['posts', 'users', 'post_count', 'user_count', 'photo_count', 'category_count'])));

    }
}
