@extends('admin.layout.main')

@section('content')

    <div class="container">
        <h2>users list</h2>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>avatar</th>
                <th>name</th>
                <th>Email</th>
                <th>created at</th>
                <th>roles</th>
                <th>status</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
                <tr>
                    @if($user->photo)
                        <td><img src="{{$user->photo->path}}" alt="sss" width="80"></td>

                    @else
                        <td> sss</td>
                    @endif
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        <ul>
                            @foreach($user->roles as $role)
                                <li> {{$role->name}}</li>
                            @endforeach
                        </ul>
                    </td>

                    @if($user->status)
                        <td class="badge badge-success"> active</td>
                    @else
                        <td class="badge badge-danger"> inactive</td>
                    @endif

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>




@endsection
