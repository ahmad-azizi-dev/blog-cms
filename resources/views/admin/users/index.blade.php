@extends('admin.layout.main')

@section('content')

    <div class="container">
        <h2>Contextual Classes</h2>
        <p>Contextual classes can be used to color table rows or table cells. The classes that can be used are: .active, .success, .info, .warning, and .danger.</p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>name</th>
                <th>Email</th>
                <th>created at</th>
                <th>roles</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
            <tr>
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
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>




@endsection
