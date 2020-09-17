@foreach($posts as $post)
    <!-- Title -->
    <h1 class="mt-4">{{Illuminate\Support\Str::limit($post->title, 80, $end='...')}}</h1>

    <!-- Author -->
    <p class="m-2">
        by user
        <b class="text-dark"> {{$post->user->name}}</b>
        <br>
        from the
        <b><a href="{{route('frontend.post.category', $post->cat->slug)}}">{{$post->cat->title}}</a></b>
        category
    </p>

    <hr>

    <!-- Date/Time -->
    <p>{{$post->created_at}}</p>


    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{url('/').$post->photo->path}}" alt="http://placehold.it/900x300">

    <hr>

    <!-- Post Content -->
    <div class="text-justify overflow-hidden">
        <p>{{Illuminate\Support\Str::limit($post->description, 200, $end='...')}}</p>
    </div>
    <hr>
    <div class="col-md-10 text-right">
        <a class="btn btn-success" href="{{route('frontend.post.show', $post->slug)}}">Read more...</a>
    </div>

    <hr>
    <hr>

@endforeach
