@extends('admin.layout.main')
@section('title')comments @endsection
@section('content')

    @if(Session::has('update_comment'))
        @include('partials.session-errors',['error'=>Session('update_comment')])
    @endif

    @if(Session::has('delete_comment'))
        @include('partials.session-errors',['error'=>Session('delete_comment')])
    @endif

    @if(Session::has('rejected_comment'))
        @include('partials.session-errors',['error'=>Session('rejected_comment')])
    @endif

    @if(Session::has('approved_comment'))
        @include('partials.session-errors',['error'=>Session('approved_comment')])
    @endif


    <div class="container">
        <h3>comments list</h3>

        <table class="table mb-4 table-responsive table-striped table-sm">
            <thead>
            <tr>
                <th>id</th>
                <th>---</th>
                <th>post</th>
                <th>user</th>
                <th>parent_id</th>
                <th>description</th>
                <th>status</th>
                <th>action</th>
                <th class="w-25">created date</th>
                <th class="w-25">updated date</th>
            </tr>
            </thead>
            <tbody>

            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td><a class=" btn btn-primary" href="{{route('comments.edit', $comment->id)}}">edit</a></td>
                    <td>
                        <a href="{{route('frontend.post.show', $comment->post->slug)}}">
                            {{Illuminate\Support\Str::limit($comment->post->title, 15, $end='...')}}</a>
                    </td>
                    <td><a href="{{route('users.edit', $comment->user->id)}}">{{$comment->user->name}}</a></td>

                    {{-- checking parent is exist!--}}
                    @if($comment->parent_id=='0')
                        <td>main</td>
                    @elseif(in_array($comment->parent_id,$all_id_comment))
                        <td>{{$comment->parent_id}}</td>
                    @else
                        <td class="badge badge-warning my-2">no_parent id={{$comment->parent_id}}</td>
                    @endif

                    <td>{{Illuminate\Support\Str::limit($comment->description, 30, $end='...')}}</td>

                    @if($comment->status)
                        <td class="badge badge-success my-2">Accepted</td>
                        <td>
                            {!! Form::open(['method' => 'POST', 'route' => ['comments.actions', $comment->id]]) !!}

                            {!! Form::hidden('action', 'rejected') !!}
                            {!! Form::submit('reject', ['class'=>'btn btn-danger']) !!}

                            {!! Form::close() !!}
                        </td>
                    @else
                        <td class="badge badge-danger my-2">Not approved</td>
                        <td>
                            {!! Form::open(['method' => 'POST', 'route' => ['comments.actions', $comment->id]]) !!}

                            {!! Form::hidden('action', 'approved') !!}
                            {!! Form::submit('confirm', ['class'=>'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </td>
                    @endif

                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    <td>{{$comment->updated_at}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="col-md-12 text-center">{{$comments->withQueryString()->links()}}</div>
    </div>

@endsection
