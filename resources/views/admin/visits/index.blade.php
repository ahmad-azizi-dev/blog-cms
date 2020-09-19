@extends('admin.layout.main')
@section('title')visits @endsection
@section('content')


    <div class="container">
        <h3>visits list</h3>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>ip</th>
                <th>country</th>
                <th>city</th>
                <th>method</th>
                <th>url</th>
                <th>device</th>
                <th>platform</th>
                <th>browser</th>
                <th>user id</th>
                <th>created date</th>

            </tr>
            </thead>
            <tbody>

            @foreach($visits as $visit)
                <tr>
                    <td><a href="{{route('visits.show', $visit->id)}}">{{$visit->ip}}</a></td>

                    @if($visit->position)
                        <td><img class="img-fluid" src="{{url('/').'/png/flags/'.
                        $visit->position->countryCode.'.png'}}" alt="">
                            {{$visit->position->countryName}}</td>

                    @else
                        <td>not found</td>
                    @endif

                    @if($visit->position)
                        <td>{{$visit->position->cityName}}</td>
                    @else
                        <td>not found</td>
                    @endif

                    <td>{{$visit->method}}</td>
                    <td>{{$visit->url}}</td>
                    <td>{{$visit->device}}</td>
                    <td>{{$visit->platform}}</td>
                    <td>{{$visit->browser}}</td>
                    <td>{{$visit->visitor_id}}</td>
                    <td>{{$visit->created_at}}</td>

                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="col-md-12 text-center">{{$visits->links()}}</div>
    </div>

@endsection
