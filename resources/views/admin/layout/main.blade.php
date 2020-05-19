<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="azizi Administrator">
    <meta name="author" content="ahmad azizi">
    <meta name="keyword" content="Bootstrap Data">

    <title>صفحه مدیریت</title>
    <!-- Icons -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="navbar-fixed sidebar-nav fixed-nav">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Logo</a>

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#">Link 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link 2</a>
        </li>

        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                users management
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('users.index')}}">users list</a>
                <a class="dropdown-item" href="{{route('users.create')}}">create user</a>
                <a class="dropdown-item" href="#">edit user</a>
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

<footer class="footer container">
        <span class="text-left">
            <a href=""> Admin UI</a> &copy;
        </span>
    <span class="pull-right">

        </span>
</footer>

<script src="{{ asset('js/app.js') }}" type="application/javascript"></script>
</body>

</html>
