@extends('admin.layout.main')
@section('title')Categories @endsection
@section('content')

    @if(Session::has('create_category'))
        <div class="alert alert-success">
            <p>{{Session('create_category')}}</p>
        </div>
    @endif

    @if(Session::has('update_category'))
        <div class="alert alert-success">
            <p>{{Session('update_category')}}</p>
        </div>
    @endif

    @if(Session::has('delete_category'))
        <div class="alert alert-danger">
            <p>{{Session('delete_category')}}</p>
        </div>
    @endif


    <div class="container">
        <h3>Categories list</h3>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>title</th>
                <th>slug</th>
                <th>description</th>
                <th>keywords</th>
                <th>created date</th>
                <th>updated date</th>
            </tr>
            </thead>
            <tbody>

            @foreach($categories as $category)
                <tr>
                    <td><a href="{{route('categories.edit', $category->id)}}">{{$category->title}}</a></td>
                    <td>{{$category->slug}}</td>
                    <td>{{Illuminate\Support\Str::limit($category->description, 50, $end='...')}}</td>
                    <td>{{$category->keywords}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
