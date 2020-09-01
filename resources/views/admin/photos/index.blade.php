@extends('admin.layout.main')
@section('title')media list @endsection
@section('content')

    @if(Session::has('delete_file'))
        <div class="alert alert-info alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p>{{Session('delete_file')}}</p>
        </div>
    @endif

    <div class="container">

        @include('partials.form-errors')

        <h2>media list</h2>

        {{--add another form for the mass_deletion action and
         associate the submit buttons with their respective forms using the form attribute HTML5 only--}}
        {!! Form::open(['method' => 'delete','action' => 'Admin\AdminPhotoController@mass_deletion','class'=>'form-inline','id'=>'mass_deletion']) !!}
        <div class="form-group mb-2">
            {!! Form::select('size', ['delete' => 'Mass deletion'],null,['id'=>'','class' => 'form-control']) !!}
            {!! Form::submit('apply',['class' => 'btn btn-primary ml-1','form'=>'mass_deletion']) !!}
        </div>
        {!! Form::close() !!}


        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    all
                    {!! Form::checkbox(null,null,null,['id'=>'options'])!!}
                </th>
                <th>photo</th>
                <th>id</th>
                <th>name</th>
                <th>path</th>
                <th>user</th>
                <th>created</th>
                <th>updated</th>
                <th>delete</th>
            </tr>
            </thead>
            <tbody>

            @foreach($photos as $photo)
                <tr>
                    <td>
                        {{-- this checkbox associated to form with 'id'=>'mass_deletion'  HTML5 only --}}
                        {!! Form::checkbox(null,$photo->id,null,['class'=>'checkBox','name'=>'checkBoxArray[]','form'=>'mass_deletion'])!!}

                    </td>
                    <td><img src="{{url('/').$photo->path}}" width="80"></td>
                    <td>{{$photo->id}}</td>
                    <td>{{$photo->name}}</td>
                    <td>{{$photo->path}}</td>
                    <td>{{$photo->user->name}}</td>
                    <td>{{$photo->created_at}}</td>
                    <td>{{$photo->updated_at}}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action'=> ['Admin\AdminPhotoController@destroy', $photo->id],'id'=>$photo->id]) !!}
                        {!! Form::hidden('currentpage', $photos->currentpage(),['form'=>$photo->id]) !!}
                        <div class="form-group">
                            {!! Form::submit('delete', ['class'=>'btn btn-danger','form'=>$photo->id]) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach

            {{--            {!! Form::hidden('path',$photos->path() ,['form'=>'mass_deletion']) !!}--}}
            {{--            {!! Form::hidden('page_count',$photos->count(),['form'=>'mass_deletion']) !!}--}}
            {!! Form::hidden('currentpage', $photos->currentpage(),['form'=>'mass_deletion']) !!}

            </tbody>
        </table>
        <div class="col-md-12 text-center">{{$photos->links()}}</div>
    </div>

@endsection

@section('scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#options').click(function () {
                if (this.checked) {
                    $('.checkBox').each(function () {
                        this.checked = true;
                    })
                } else {
                    $('.checkBox').each(function () {
                        this.checked = false;
                    })
                }
            })
        })
    </script>
@endsection
