@extends('admin.layout.main')
@section('title')Dashboard @endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card bg-primary p-2 m-2">
                    <div class="card-block p-b-0">
                        <h4 class="m-b-0">{{$post_count}}</h4>
                        <h5>Number of posts</h5>
                    </div>
                    <div class="chart-wrapper p-x-1">
                        <canvas id="card-chart1" class="chart" height="40"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card bg-warning p-2 m-2">
                    <div class="card-block p-b-0">
                        <h4 class="m-b-0">{{$category_count}}</h4>
                        <h5>Number of categories</h5>
                    </div>
                    <div class="chart-wrapper p-x-1">
                        <canvas id="card-chart2" class="chart" height="40"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card bg-success p-2 m-2">
                    <div class="card-block p-b-0">
                        <h4 class="m-b-0">{{$photo_count}}</h4>
                        <h5>Number of medias</h5>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="card-chart3" class="chart" height="40"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card bg-danger p-2 m-2">
                    <div class="card-block p-b-0">
                        <h4 class="m-b-0">{{$user_count}}</h4>
                        <h5>Number of users</h5>
                    </div>
                    <div class="chart-wrapper p-x-1">
                        <canvas id="card-chart4" class="chart" height="40"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->

        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <h4 class="p-b-2">last posts</h4>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>title</th>
                        <th>category</th>
                        <th class="w-25">created date</th>
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
                <h4 class="p-b-2">last users</h4>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>user name</th>
                        <th>email</th>
                        <th class="w-25">created date</th>
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


