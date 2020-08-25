@extends('admin.layout.main')
@section('title')Dashboard @endsection

@section('styles')
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-primary">
                    <div class="card-block p-b-0">
                        <h4 class="m-b-0">{{$post_count}}</h4>
                        <h5>Number of posts</h5>
                    </div>
                    <div class="chart-wrapper p-x-1" style="height:70px;">
                        <canvas id="card-chart1" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-info">
                    <div class="card-block p-b-0">
                        <h4 class="m-b-0">{{$category_count}}</h4>
                        <h5>Number of categories</h5>
                    </div>
                    <div class="chart-wrapper p-x-1" style="height:70px;">
                        <canvas id="card-chart2" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-warning">
                    <div class="card-block p-b-0">
                        <h4 class="m-b-0">{{$photo_count}}</h4>
                        <h5>Number of medias</h5>
                    </div>
                    <div class="chart-wrapper" style="height:70px;">
                        <canvas id="card-chart3" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-danger">
                    <div class="card-block p-b-0">
                        <h4 class="m-b-0">{{$user_count}}</h4>
                        <h5>Number of users</h5>
                    </div>
                    <div class="chart-wrapper p-x-1" style="height:70px;">
                        <canvas id="card-chart4" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->

        </div>
        <div class="row">
            <div class="col-md-6">
                <h6 class="p-b-2">last posts</h6>
                <table class="table table-hover bg-content">
                    <thead>
                    <tr>
                        <th>title</th>
                        <th>category</th>
                        <th>created date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                            <td>{{$post->cat->title}}</td>
                            <td>{{$post->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="p-b-2">last users</h6>
                <table class="table table-hover bg-content">
                    <thead>
                    <tr>
                        <th>user name</th>
                        <th>email</th>
                        <th>created date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


