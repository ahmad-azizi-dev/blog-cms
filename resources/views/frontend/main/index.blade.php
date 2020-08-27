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
    @include('partials.form-errors')

    @foreach($posts as $post)
        <!-- Title -->
        <h1 class="mt-4">{{Illuminate\Support\Str::limit($post->title, 80, $end='...')}}</h1>

        <!-- Author -->
        <p class="lead">
            by
            <a href="#">{{$post->user->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>{{$post->created_at}}</p>


        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{url('/').$post->photo->path}}" alt="http://placehold.it/900x300">

        <hr>

        <!-- Post Content -->
        <div class="text-justify">
          <p>{{Illuminate\Support\Str::limit($post->description, 200, $end='...')}}</p>
        </div>
        <hr>
        <div class="col-md-10 text-right">
            <a class="btn btn-success" href="{{route('frontend.post.show', $post->slug)}}">Read more...</a>
        </div>





        <hr>
        <hr>

    @endforeach

    <div class="col-md-12 text-center">{{$posts->links()}}</div>

@endsection
