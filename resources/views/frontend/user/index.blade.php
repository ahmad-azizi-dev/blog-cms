@extends('frontend.layouts.main')
@section('head')
    <meta name="description" content="{{$user->email}}">
    <meta name="keywords" content="{{$user->name}}">
    <meta name="author" content="{{$user->name}}">
    <title>user: {{$user->name}}</title>
@endsection

@section('categories')
    @include('partials.categories',['categories'=>$categories])
@endsection

@section('content')

    @include('partials.form-errors')

    @if(Session::has('update_user'))
        <div class="alert alert-info alert-dismissible fade show mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p>{{Session('update_user')}}</p>
        </div>
    @endif


    <div class="container">
        <hr>
        <h2><b>user:</b> {{$user->name}}</h2>
        <h3><b>email:</b> {{$user->email}}</h3>
        <hr>
        <img src="{{ $user->photo ? url('/').$user->photo->path : 'https://placehold.it/200'}}"
             width="200" alt="sss" class="img-fluid rounded mt-3 mb-4">

        {!! Form::model($user ,['method' => 'PATCH','action' => ['Frontend\UserPanelController@update', $user->id] , 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('name', 'username') !!}
            {!! Form::text('name',null, ['class' => 'form-control']);!!}
        </div>

        <div class="form-group">
            {!! Form::label('photo', 'avatar') !!}
            {!! Form::file('photo',null , ['class' => 'form-control']);!!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'password') !!}
            <br>
            {!! Form::password('password',null, ['class' => 'form-control']);!!}
        </div>
        <div class="form-group">
            {!! Form::label('new_password', 'new password') !!}
            <br>
            {!! Form::password('new_password',null, ['class' => 'form-control']);!!}
        </div>
        <div class="form-group">
            {!! Form::label('new_confirm_password', 'confirm new password') !!}
            <br>
            {!! Form::password('new_confirm_password',null, ['class' => 'form-control']);!!}
        </div>
        <hr>
        <div class="form-group">
            {!! Form::submit('update',['class' => 'btn btn-success col-md-3']); !!}

        </div>
        {!! Form::close() !!}


    </div>

@endsection
