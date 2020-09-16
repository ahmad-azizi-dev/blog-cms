@extends('admin.layout.main')

@section('content')
    <div class="container">
        @include('partials.form-errors')

        <h2>create user</h2>
        <div class="col-md-6 ">

            {!! Form::open(['method' => 'post','action' => 'Admin\AdminUserController@store' , 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('name', 'username') !!}
                {!! Form::text('name',null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'E-Mail Address') !!}
                {!! Form::text('email',null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('roles', 'role') !!}
                {!! Form::select('roles[]',$roles, null ,['multiple'=>'multiple','class' => 'form-control'] );!!}
            </div>
            <div class="form-group">
                {!! Form::label('status', 'status') !!}
                {!! Form::select('status',[0=>'inactive',1=>'active'], ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('photo', 'avatar') !!}
                {!! Form::file('photo',null , ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'password') !!}
                {!! Form::password('password',null, ['class' => 'form-control']);!!}

                <div class="form-group">
                    {!! Form::submit('submit',['class' => 'btn btn-success']); !!}

                </div>
                {!! Form::close() !!}

            </div>


        </div>


@endsection
