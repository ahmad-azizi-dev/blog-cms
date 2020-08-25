<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="azizi Administrator">
    <meta name="author" content="ahmad azizi">
    <meta name="keyword" content="Bootstrap Data">

    <title> @yield('title')</title>
    <!-- Icons -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')

</head>

<body class="navbar-fixed sidebar-nav fixed-nav">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.index')}}">Dashboard</a>
        </li>

        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                users management
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('users.index')}}">users list</a>
                <a class="dropdown-item" href="{{route('users.create')}}">create user</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                posts management
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('posts.index')}}">posts list</a>
                <a class="dropdown-item" href="{{route('posts.create')}}">create new post</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                categories
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('categories.index')}}">categories list</a>
                <a class="dropdown-item" href="{{route('categories.create')}}">create new category</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                media manager
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('photos.index')}}">media list</a>
                <a class="dropdown-item" href="{{route('photos.create')}}">upload new media</a>
            </div>
        </li>
    </ul>
</nav>
<br>

<div class="container">


    <div class="row">

        @yield('content')

    </div>

</div>

<br>
<br>
<footer class=" container">
        <span class="text-left">
            <a href=""> Admin UI</a> &copy;
        </span>
    <span class="pull-right">

        </span>
</footer>

<script src="{{ asset('js/app.js') }}" type="application/javascript"></script>
@yield('scripts')
</body>

</html>
