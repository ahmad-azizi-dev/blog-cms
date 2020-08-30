@extends('frontend.layouts.main')

@section('head')
    <meta name="description" content="{{$post->meta_description}}">
    <meta name="keywords" content="{{$post->meta_keywords}}">
    <meta name="author" content="{{$post->user->name}}">
    <title>{{$post->title}}</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection

@section('categories')
    @include('partials.categories',['categories'=>$categories])
@endsection

@section('content')
    @include('partials.form-errors')

    @if(Session::has('add_comment'))
        <div class="alert alert-info alert-dismissible fade show mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p>{{Session('add_comment')}}</p>
        </div>
    @endif
    <!-- Title -->
    <h1 class="mt-4">{{$post->title}}</a></h1>

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
        <p>{{$post->description}}</p>
    </div>
    <hr>
    <!-- Comments Form -->
    <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
            {!! Form::open(['method' => 'POST', 'route'=> ['frontend.comments.store', $post->id]]) !!}
            <div class="form-group">
                {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'3']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- Single Comment -->
    @include('partials.comments', ['comments'=> $post->comments, 'post'=> $post])

    <script type="text/javascript">
        $(".btn-open").click(function () {
            $('.form-reply').css('display', 'none')
            var service = this.id
            var service_id = '#f-' + service
            $(service_id).show('slow');
        })
    </script>

@endsection

