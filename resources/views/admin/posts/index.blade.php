@extends('admin.layout.main')
@section('title')posts list @endsection

@section('content')

    @if(Session::has('create_post'))
        <div class="alert alert-success">
            <p>{{Session('create_post')}}</p>
        </div>
    @endif

    @if(Session::has('update_post'))
        <div class="alert alert-success">
            <p>{{Session('update_post')}}</p>
        </div>
    @endif

    @if(Session::has('delete_post'))
        <div class="alert alert-danger">
            <p>{{Session('delete_post')}}</p>
        </div>
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
                        <td><img src="{{url('/').$post->photo->path}}" alt="http://placehold.it/200" width="80"></td>

                    @else
                        <td><img src="http://placehold.it/200" alt="http://placehold.it/200" width="80"></td>
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
