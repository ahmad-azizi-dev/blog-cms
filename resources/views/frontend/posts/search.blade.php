@extends('frontend.layouts.main')

@section('head')
    <meta name="description" content="search in posts">
    <meta name="keywords" content="search posts">
    <meta name="author" content="ahmad azizi">
    <title>search in posts</title>
@endsection

@section('categories')
    @include('partials.categories',['categories'=>$categories])
@endsection

@section('content')
    @include('partials.form-errors')
    <h4 class="mt-4">{{'search result for: "'.$q.'"'}}</h4>
    </br>

    @if(count($posts)==0)
        <div class="col-md-auto"><img src="{{asset('png/not_found.png')}}" width="400" class="img-fluid"></div>
    @endif

    {{--       displaying the minimized posts contents--}}
    @include('frontend.partials.posts-min',['posts'=>$posts])

    <div class="col-md-12 text-center">{{$posts->withQueryString()->links()}}</div>

@endsection
