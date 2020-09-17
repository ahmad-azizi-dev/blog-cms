@extends('frontend.layouts.main')

@section('head')
    <meta name="description" content="{{$this_category->description}}">
    <meta name="keywords" content="{{$this_category->keywords}}">
    <meta name="author" content="ahmad azizi">
    <title>{{$this_category->title}}</title>
@endsection

@section('categories')
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">

                @foreach($categories->chunk(ceil($categories->count()/2)) as $category)
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            @foreach($category as $category1)

                                <li class="overflow-hidden">
                                    @if($category1->title == $this_category->title)
                                        <ins class="text-danger"><b> {{$this_category->title}} </b></ins>
                                    @else
                                        <a href="{{route('frontend.post.category', $category1->slug)}}">{{$category1->title}}</a>
                                    @endif
                                </li>

                            @endforeach
                        </ul>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('partials.form-errors')
    <h4 class="mt-4">{{'results for category: "'.$this_category->title.'"'}}</h4>
    </br>

    @if(count($posts)==0)
        <div class="col-md-auto"><img src="{{asset('png/not_found.png')}}" width="400" class="img-fluid"></div>
    @endif

    {{--       displaying the minimized posts contents--}}
    @include('frontend.partials.posts-min',['posts'=>$posts])

    <div class="col-md-12 text-center">{{$posts->links()}}</div>

@endsection
