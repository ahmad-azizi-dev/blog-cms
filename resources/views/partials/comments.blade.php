@foreach($comments as $comment)
    @if($comment->status)
        <div class="mb-4
        @if($comment->parent_id != 0)
        ml-4
        @endif ">

                <img class="d-flex mr-3 rounded-circle media-object float-left"
                 @if($comment->user->photo_id)
                 src="{{url('/').$comment->user->photo->path}}"
                 @else
                 src="{{asset('png/personal.png')}}"
                 @endif
                 width="50" height="50">

            <div class="media-body">
                <h5 class="mt-0">{{$comment->user->name}}</h5>
                <h6 class="mt-0">{{$comment->created_at}}</h6>
                <P class="text-justify overflow-hidden">{{$comment->description}}</P>
                <div class=" mt-2 mb-2 row">
                    <div class="col-md-12 mb-2">
                        <button class="btn btn-warning btn-open" id="div-comment-{{$comment->id}}">Reply</button>
                    </div>
                    <div class="form-reply col-md-12" id="f-div-comment-{{$comment->id}}" style="display: none">
                        {!! Form::open(['method' => 'POST', 'route'=> ['frontend.comments.reply']]) !!}

                        <div class="form-group">
                            {!! Form::hidden('parent_id', $comment->id) !!}
                            {!! Form::hidden('post_id', $post->id) !!}

                            {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Submit', ['class'=>'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
            @include('partials.comments', ['comments' => $comment->replies])
        </div>
    @endif
@endforeach
