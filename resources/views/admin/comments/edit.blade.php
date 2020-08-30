@extends('admin.layout.main')
@section('title')Admin edit Category @endsection
@section('content')

    <div class="container">
        @include('partials.form-errors')
        <h3>edit category: {{$comment->title}}</h3>

        <div class="col-md-6 ">

            {!! Form::model($comment, ['action' => ['Admin\CommentController@update', $comment->id], 'method' => 'PATCH']) !!}

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('update', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
            {!! Form::open(['method' => 'DELETE', 'action'=> ['Admin\CommentController@destroy', $comment->id]]) !!}
            <div class="form-group">
                {!! Form::submit('delete', ['class'=>'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>


@endsection
