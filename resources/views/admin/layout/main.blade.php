
<!DOCTYPE html>
<html lang="IR-fa" dir="rtl">

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

<div class="row">

@yield('content')

</div>

<footer class="footer">
        <span class="text-left">
            <a href=""> Admin UI</a> &copy;
        </span>
    <span class="pull-right">
            Powered by <a href="">CoreUI</a>
        </span>
</footer>

<script src="{{ asset('js/app.js') }}" type="application/javascript"></script>
</body>

</html>
