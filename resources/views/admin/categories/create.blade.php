@extends('admin.layout.main')
@section('title')Create Category @endsection
@section('content')


    <div class="container">
        <div class="col-md-10 ">
            @include('partials.form-errors')
            <h3>Create Category</h3>

            {!! Form::open(['method' => 'post','action' => 'Admin\AdminCategoryController@store']) !!}
            <div class="form-group">
                {!! Form::label('title', 'Category title') !!}
                {!! Form::text('title',null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'slug') !!}
                {!! Form::text('slug',null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'description') !!}
                {!! Form::textarea('description',null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::label('keywords', 'keywords') !!}
                {!! Form::textarea('keywords',null, ['class' => 'form-control']);!!}
            </div>
            <div class="form-group">
                {!! Form::submit('submit',['class' => 'btn btn-success']); !!}

            </div>
            {!! Form::close() !!}

        </div>

    </div>


@endsection
