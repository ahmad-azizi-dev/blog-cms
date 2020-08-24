@extends('admin.layout.main')
@section('title')upload media @endsection
@section('styles')
    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
@endsection

@section('content')



    <div class="container">

        @include('partials.form-errors')

        <h2>upload media</h2>
        <br>
        <br>
        <div class="col-md-10 ">

            {!! Form::open(['method' => 'post','action' => 'Admin\AdminPhotoController@store' ,  'class'=>'dropzone' ]) !!}

            {!! Form::close() !!}

        </div>


    </div>



@endsection

@section('scripts')
    <script src="{{ asset('js/dropzone.min.js') }}" type="application/javascript"></script>
@endsection
