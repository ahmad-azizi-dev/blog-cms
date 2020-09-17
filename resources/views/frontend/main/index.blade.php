@extends('frontend.layouts.main')

@section('head')
    <meta name="description" content="CMS-Blog">
    <meta name="keywords" content="blog cms">
    <meta name="author" content="ahmad azizi">
    <title>blog-cms</title>
@endsection

@section('categories')
    @include('partials.categories',['categories'=>$categories])
@endsection

@section('content')

    <div class="card mt-4">
        <h6 class="card-body text-center">Welcome to your page &#128512;
            <br>
            <div class="spinner-grow spinner-grow-sm"></div>
            your ip is <b>{{$ip}}</b>
            <div class="spinner-grow spinner-grow-sm"></div>
        </h6>
    </div>

    @include('partials.form-errors')

    {{--    displaying the minimized posts contents--}}
    @include('frontend.partials.posts-min',['posts'=>$posts])

    <div class="col-md-12 text-center">{{$posts->links()}}</div>

@endsection
