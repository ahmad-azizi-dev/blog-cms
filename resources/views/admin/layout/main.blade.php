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
    <link rel="icon" href="{{ asset('png/icon.png') }}" type="image/png" sizes="32x32">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/blog-post.css') }}" rel="stylesheet">

    @yield('styles')

</head>

<body class="">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.index')}}">Dashboard</a>
        </li>
    </ul>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <!-- Dropdown -->
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>

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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    comments
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('comments.index')}}">comments list</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    visits
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('visits.index')}}">last visits list</a>
                </div>
            </li>
        </ul>
    </div>

</nav>
<br>

<div class="container-fluid table-responsive mt-5">


    <div class="row">

        @yield('content')

    </div>

</div>

<br>
<br>
<!-- Footer -->
@include('partials.footer')

<script src="{{ asset('js/jquery.min.js') }}" type="application/javascript"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="application/javascript"></script>
@yield('scripts')
</body>

</html>
