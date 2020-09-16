@if(count($errors)>0)
    <br>
    <div class="alert alert-info alert-dismissible fade show mt-2">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
