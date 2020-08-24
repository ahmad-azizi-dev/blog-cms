@extends('admin.layout.main')
@section('title')media list @endsection
@section('content')


    @if(Session::has('delete_file'))
        <div class="alert alert-danger">
            <p>{{Session('delete_file')}}</p>
        </div>
    @endif

    <div class="container">
        <h2>media list</h2>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>photo</th>
                <th>id</th>
                <th>name</th>
                <th>path</th>
                <th>user</th>
                <th>created</th>
                <th>updated</th>
                <th>delete</th>
            </tr>
            </thead>
            <tbody>

            @foreach($photos as $photo)
                <tr>
                    <td><img src="{{url('/').$photo->path}}"  width="80"></td>
                    <td>{{$photo->id}}</td>
                    <td>{{$photo->name}}</td>
                    <td>{{$photo->path}}</td>
                    <td>{{$photo->user->name}}</td>
                    <td>{{$photo->created_at}}</td>
                    <td>{{$photo->updated_at}}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action'=> ['Admin\AdminPhotoController@destroy', $photo->id]]) !!}
                        <div class="form-group">
                        {!! Form::submit('delete', ['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>




@endsection
