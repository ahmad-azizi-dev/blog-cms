@extends('admin.layout.main')
@section('title')create post @endsection
@section('content')

    <div class="container">
        @include('partials.form-errors')

        <h2>create post</h2>
        <div class="col-md-10 ">

            {!! Form::open(['method' => 'post','action' => 'Admin\AdminPostController@store' , 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('title', 'post title') !!}
                {!! Form::text('title',null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'slug') !!}
                {!! Form::text('slug',null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('cats', 'categories') !!}
                {!! Form::select('cats',$cats, null ,['class' => 'form-control'] );!!}
            </div>
            <div class="form-group">
                {!! Form::label('meta_description', 'meta description') !!}
                {!! Form::textarea('meta_description',null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'description') !!}
                {!! Form::textarea('description',null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('meta_keywords', 'keywords') !!}
                {!! Form::textarea('meta_keywords',null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('status', 'status') !!}
                {!! Form::select('status',[0=>'inactive',1=>'active'], ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('photo', 'main photo') !!}
                {!! Form::file('photo',null , ['class' => 'form-control']);!!}
            </div>

            <div class="form-group">
                {!! Form::submit('submit',['class' => 'btn btn-success']); !!}

            </div>
            {!! Form::close() !!}

        </div>


    </div>


@endsection
