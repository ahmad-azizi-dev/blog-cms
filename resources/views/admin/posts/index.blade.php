@extends('admin.layout.main')
@section('title')posts list @endsection

@section('content')

    @if(Session::has('create_post'))
        @include('partials.session-errors',['error'=>Session('create_post')])
    @endif

    @if(Session::has('update_post'))
        @include('partials.session-errors',['error'=>Session('update_post')])
    @endif

    @if(Session::has('delete_post'))
        @include('partials.session-errors',['error'=>Session('delete_post')])
    @endif

    <div class="container">
        <h2>posts list</h2>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>photo</th>
                <th>title</th>
                <th>user</th>
                <th>description</th>
                <th>category</th>
                <th>created date</th>
                <th>status</th>
            </tr>
            </thead>
            <tbody>

            @foreach($posts as $post)
                <tr>
                    @if($post->photo)
                        <td><img src="{{url('/').$post->photo->path}}" alt="https://placehold.it/200" width="80"></td>

                    @else
                        <td><img src="https://placehold.it/200" alt="https://placehold.it/200" width="80"></td>
                    @endif
                    <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                    <td><a href="{{route('users.edit', $post->user->id)}}">{{$post->user->name}}</a></td>
                    <td>{{Illuminate\Support\Str::limit($post->description, 50, $end='...')}}</td>
                    <td>{{$post->cat->title}}</td>
                    <td>{{$post->created_at}}</td>

                    @if($post->status)
                        <td class="badge badge-success"> active</td>
                    @else
                        <td class="badge badge-danger"> inactive</td>
                    @endif
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="col-md-12 text-center">{{$posts->links()}}</div>
    </div>




@endsection
