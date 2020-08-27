<div class="card my-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
        {!! Form::open(['method' => 'get','action' => 'Frontend\PostController@search_title' ]) !!}
        <div class="input-group">
            {!! Form::text('q',null, ['class' => 'form-control','placeholder'=>"Search for..."]);!!}
            <span class="input-group-append">
            {!! Form::submit('Go!',['class' => 'btn btn-secondary']); !!}
            </span>
        </div>
        {!! Form::close() !!}
    </div>
</div>
