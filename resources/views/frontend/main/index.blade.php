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

    <div class="card mt-4">
        <div class="alert alert-dismissible fade show container p-0">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h6 class="card-body text-center m-0">Welcome to your page &#128512;
                <br>

                @if($location)
                    <span class="text-danger"> your ip is </span><b>{{$location->ip}}</b>
                    @if($location->countryName)
                        <span class="text-danger">/ <img class="img-fluid" src="{{url('/').'/png/flags/'.
                        Illuminate\Support\Str::lower($location->countryCode).'.png'}}" alt="">
                        </span><b>{{$location->countryName}}</b>
                    @endif
                    @if($location->cityName)
                        <span class="text-danger">/ </span><b>{{$location->cityName}}</b>
                    @endif
                @endif

            </h6>
        </div>
    </div>

    @include('partials.form-errors')

    {{--    displaying the minimized posts contents--}}
    @include('frontend.partials.posts-min',['posts'=>$posts])

    <div class="col-md-12 text-center">{{$posts->withQueryString()->links()}}</div>

    <div class="col-md-4 mb-5">
        {!! Form::open(['method' => 'get','action' => 'Frontend\MainController@index','class'=>'form-inline']) !!}
        <div class="form-group mb-2">
            {!! Form::select('PerPage', ['3' => '3','5' => '5','10' => '10','15' => '15','20' => '20','25' => '25','30' => '30'],
            Session('PerPagePost'),['class' => 'form-control', 'data-toggle'=>'tooltip','title'=>'posts per page','data-placement'=>'bottom']) !!}

            {!! Form::submit('show',['class' => 'btn btn-primary m-1']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
