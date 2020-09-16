@extends('admin.layout.main')

@section('content')


    <div class="container">
        @include('partials.form-errors')

        <h2>edit user: {{$user->name}}</h2>

        <div class="col-md-3 float-right"><img src="{{ $user->photo ? url('/').$user->photo->path : 'https://placehold.it/200'}}"
                                               alt="https://placehold.it/200" width="200" alt="sss" class="img-fluid">
        </div>
        <div class="col-md-6 ">

            {!! Form::model($user ,['method' => 'PATCH','action' => ['Admin\AdminUserController@update', $user->id] , 'files'=>true]) !!}
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
                {!! Form::select('status',[0=>'inactive',1=>'active'],null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('photo', 'avatar') !!}
                {!! Form::file('photo',null , ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'password') !!}
                {!! Form::password('password',null, ['class' => 'form-control']);!!}

                <div class="form-group">
                    {!! Form::submit('update',['class' => 'btn btn-success col-md-3']); !!}

                </div>
                {!! Form::close() !!}

                {!! Form::open(['method' => 'DELETE','action' => ['Admin\AdminUserController@destroy',$user->id] , ]) !!}
                <div class="form-group">
                    {!! Form::submit('delete',['class' => 'btn btn-danger col-md-2']); !!}

                </div>
                {!! Form::close() !!}

            </div>


        </div>


@endsection
