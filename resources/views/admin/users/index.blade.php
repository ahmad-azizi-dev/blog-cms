@extends('admin.layout.main')
@section('title')users list @endsection

@section('content')


    @if(Session::has('create_user'))
        <div class="alert alert-success">
            <p>{{Session('create_user')}}</p>
        </div>
    @endif

    @if(Session::has('update_user'))
        <div class="alert alert-success">
            <p>{{Session('update_user')}}</p>
        </div>
    @endif

    @if(Session::has('delete_user'))
        <div class="alert alert-danger">
            <p>{{Session('delete_user')}}</p>
        </div>
    @endif


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
                        <td><img src="{{url('/').$user->photo->path}}" alt="http://placehold.it/200" width="80"></td>

                    @else
                        <td><img src="http://placehold.it/200" alt="http://placehold.it/200" width="80"></td>
                    @endif
                    <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
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
        <div class="col-md-12 text-center">{{$users->links()}}</div>
    </div>




@endsection
