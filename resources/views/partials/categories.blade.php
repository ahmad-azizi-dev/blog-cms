<div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
        <div class="row">

            @foreach($categories->chunk(ceil($categories->count()/2)) as $category)
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        @foreach($category as $category1)

                            <li><a href="{{route('frontend.post.category', $category1->slug)}}">{{$category1->title}}</a>
                            </li>

                        @endforeach
                    </ul>
                </div>
            @endforeach

        </div>
    </div>
</div>
