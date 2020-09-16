@extends('admin.layout.main')
@section('title')edit post @endsection
@section('content')


    <div class="container">
        @include('partials.form-errors')

        <h2>edit post: {{$post->title}}</h2>

        <div class="col-md-3 float-right"><img
                src="{{ $post->photo ? url('/').$post->photo->path : 'https://placehold.it/200'}}"
                alt="https://placehold.it/200" width="300" alt="sss" class="img-fluid">
        </div>
        <div class="col-md-6 ">

            {!! Form::model($post, ['action' => ['Admin\AdminPostController@update', $post->id], 'method' => 'PATCH', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('title', 'Title') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('cats', 'Category') !!}
                {!! Form::select('cats', $categories, $post->cat->id, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('status', 'Status') !!}
                {!! Form::select('status', [1 => 'active', 0 => 'inactive'], null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('photo', 'Photo') !!}
                {!! Form::file('photo', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('meta_description', 'Meta Description') !!}
                {!! Form::textarea('meta_description', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('meta_keywords', 'Meta Keywords') !!}
                {!! Form::textarea('meta_keywords', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('update', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
            {!! Form::open(['method' => 'DELETE', 'action'=> ['Admin\AdminPostController@destroy', $post->id]]) !!}
            <div class="form-group">
                {!! Form::submit('delete', ['class'=>'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}

        </div>
@endsection
