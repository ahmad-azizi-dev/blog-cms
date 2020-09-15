<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

@yield('head')

<!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/blog-post.css') }}" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
@include('partials.navigation')

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            @yield('content')

        </div>
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
        @include('partials.search')

        <!-- Categories Widget -->
        @yield('categories')

        <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Side Widget</h5>
                <div class="card-body">
                    You can put anything you want inside of these side widgets. They are easy to use, and feature
                    the new Bootstrap 4 card containers!
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <h3>Site Map</h3>
                <ul class="list-unstyled three-column">
                    <li>Home</li>
                    <li>Services</li>
                    <li>About</li>
                    <li>Code</li>
                    <li>Design</li>
                    <li>Host</li>
                    <li>Contact</li>
                    <li>Company</li>
                </ul>
                <ul class="list-unstyled socila-list">
                    <li><img src="http://placehold.it/48x48" alt="" /></li>
                    <li><img src="http://placehold.it/48x48" alt="" /></li>
                    <li><img src="http://placehold.it/48x48" alt="" /></li>
                    <li><img src="http://placehold.it/48x48" alt="" /></li>
                    <li><img src="http://placehold.it/48x48" alt="" /></li>
                    <li><img src="http://placehold.it/48x48" alt="" /></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h3>latest Articles</h3>
                <div class="media">
                    <a href="#" class="pull-left">
                        <img src="http://placehold.it/64x64" alt="" class="media-object" />
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Programming</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>

                <div class="media">
                    <a href="#" class="pull-left">
                        <img src="http://placehold.it/64x64" alt="" class="media-object" />
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Coding</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>

                <div class="media">
                    <a href="#" class="pull-left">
                        <img src="http://placehold.it/64x64" alt="" class="media-object" />
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Web Sesign</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">
                <h3>Our Work</h3>
                <img class="img-thumbnail" src="http://placehold.it/150x100" alt="" />
                <img class="img-thumbnail" src="http://placehold.it/150x100" alt="" />
                <img class="img-thumbnail" src="http://placehold.it/150x100" alt="" />
                <img class="img-thumbnail" src="http://placehold.it/150x100" alt="" />
            </div>

        </div>
    </div>
    <div class="copyright text-center">
        Copyright &copy; 2019 <span>Your Template Name</span>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


</body>

</html>

