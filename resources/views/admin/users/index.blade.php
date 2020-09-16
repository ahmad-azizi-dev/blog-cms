@extends('admin.layout.main')
@section('title')users list @endsection

@section('content')


    @if(Session::has('create_user'))
        @include('partials.session-errors',['error'=>Session('create_user')])
    @endif

    @if(Session::has('update_user'))
        @include('partials.session-errors',['error'=>Session('update_user')])
    @endif

    @if(Session::has('delete_user'))
        @include('partials.session-errors',['error'=>Session('delete_user')])
    @endif


    <div class="container">
        <h2>users list</h2>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>avatar</th>
                <th>name</th>
                <th>Email</th>
                <th class="w-25">created at</th>
                <th>roles</th>
                <th>status</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
                <tr>
                    @if($user->photo)
                        <td><img src="{{url('/').$user->photo->path}}" alt="https://placehold.it/200" width="80"></td>

                    @else
                        <td><img src="https://placehold.it/200" alt="https://placehold.it/200" width="80"></td>
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
