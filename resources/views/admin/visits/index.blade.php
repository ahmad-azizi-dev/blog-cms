@extends('admin.layout.main')
@section('title')visits @endsection
@section('content')

    <div class="col-md-12 m-auto align-content-center ">

        @if(Session::has('visit'))
            @include('partials.session-errors',['error'=>Session('visit')])
        @endif

        @include('partials.form-errors')

        <h3>visits list</h3>
        <div class="col-md-4 float-left">
            {{--added another forms for the mass_deletion action and
             associate the submit buttons with their respective forms using the form attribute HTML5 only--}}
            {!! Form::open(['method' => 'delete','action' => 'Admin\AdminVisitController@mass_deletion','class'=>'form-inline','id'=>'mass_deletion']) !!}
            <div class="form-group mb-2">
                {!! Form::select('size', ['delete' => 'Mass deletion'],null,['id'=>'','class' => 'form-control']) !!}
                {!! Form::submit('apply',['class' => 'btn btn-primary m-1','form'=>'mass_deletion']) !!}
            </div>
            {!! Form::close() !!}
        </div>


        <table class="mb-4 table-responsive table-striped ">
            <thead>
            <tr>
                <th>
                    all
                    {!! Form::checkbox(null,null,null,['id'=>'options'])!!}
                    id
                </th>
                <th>IP</th>
                <th>country</th>
                <th>city</th>
                <th>referer</th>
                <th>sm-URL</th>
                <th>device</th>
                <th>browser</th>
                <th>user</th>
                <th>visitable</th>
                <th>date Teh</th>
                <th>diff</th>
                <th>delete</th>

            </tr>
            </thead>
            <tbody>

            @foreach($visits as $visit)
                <tr>
                    <td>
                        {{-- this checkbox associated to form with 'id'=>'mass_deletion'  HTML5 only --}}
                        {!! Form::checkbox(null,$visit->id,null,['class'=>'checkBox','name'=>'checkBoxArray[]','form'=>'mass_deletion'])!!}
                        {{$visit->id}}
                    </td>
                    <td>
                        <a class="btn btn-primary" data-toggle="tooltip" title="show details"
                           href="{{route('visits.show', $visit->id)}}">{{$visit->ip}}</a>
                    </td>

                    @if($visit->position)
                        <td>
                            @if($visit->position->countryName)
                                <img class="img-fluid" src="{{url('/').'/png/flags/'.
                                     $visit->position->countryCode.'.png'}}" alt="">
                                {{$visit->position->countryName}}
                            @else
                                <div class="spinner-border spinner-border-sm"></div>
                            @endif
                        </td>
                    @else
                        <td><span class="text-danger">not try</span></td>
                    @endif

                    @if($visit->position)
                        <td>
                            @if($visit->position->cityName)
                                {{$visit->position->cityName}}
                            @else
                                <div class="spinner-border spinner-border-sm"></div>
                            @endif
                        </td>
                    @else
                        <td><span class="text-danger">not try</span></td>
                    @endif

                    @if(Illuminate\Support\Str::length($url= Illuminate\Support\Str::limit(
                        Illuminate\Support\Str::after($visit->referer, url('/')), 50, $end='...') )>1)
                        <td>{{$url}}</td>
                    @elseif($visit->referer)
                        <td><span class="text-warning">home page</span></td>
                    @else
                        <td><span class="text-danger">not found</span></td>
                    @endif

                    @if($url= Illuminate\Support\Str::limit(Illuminate\Support\Str::after($visit->url, url('/')), 50, $end='...' ))
                        <td>{{$url}}</td>
                    @else
                        <td><span class="text-warning">home page</span></td>
                    @endif

                    <td>{{$visit->platform .'/ ['. $visit->device.']'}}</td>
                    <td>{{$visit->browser}}</td>

                    @if($visit->user)
                        <td>
                            <a href="{{route('users.edit', $visit->user->id)}}">
                                {{Illuminate\Support\Str::limit($visit->user->name, 15)}}</a>
                        </td>
                    @else
                        <td><span class="text-success">guest</span></td>
                    @endif

                    @if($visit->visitable)
                        @if($visit->visitable_type == 'App\Post')
                            <td>post: <a href="{{route('posts.edit', $visit->visitable->id)}}">
                                    {{Illuminate\Support\Str::limit($visit->visitable->title, 20, $end='...')}}</a></td>
                        @elseif($visit->visitable_type == 'App\Cat')
                            <td>cat: <a href="{{route('categories.edit', $visit->visitable->id)}}">
                                    {{Illuminate\Support\Str::limit($visit->visitable->title, 20, $end='...')}}</a></td>
                        @endif
                    @else
                        <td><span class="text-success">---</span></td>
                    @endif

                    <td>
                        <b class="text-danger">{{$visit->created_at->setTimezone('Asia/Tehran')->isoFormat('HH:mm M/D')}}</b>
                    </td>
                    <td><b>{{$visit->created_at->diffForHumans()}}</b></td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action'=> ['Admin\AdminVisitController@destroy', $visit->id],'id'=>$visit->id]) !!}
                        {!! Form::hidden('currentpage', $visits->currentpage(),['form'=>$visit->id]) !!}
                        <div class="form-group">
                            {!! Form::submit('delete', ['class'=>'btn btn-danger','form'=>$visit->id]) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>

                </tr>
            @endforeach

            {!! Form::hidden('currentpage', $visits->currentpage(),['form'=>'mass_deletion']) !!}

            </tbody>
        </table>
        <div class="col-md-12 text-center">{{$visits->withQueryString()->links()}}</div>

        <div class="col-md-4">
            {!! Form::open(['method' => 'get','action' => 'Admin\AdminVisitController@index','class'=>'form-inline']) !!}
            <div class="form-group mb-2">

                {!! Form::select('PerPage', ['5' => '5 ','10' => '10','20' => '20','30' => '30','40' => '40','60' => '60','80' => '80','100' => '100'],
                Session('PerPageVisit'),['class' => 'form-control', 'data-toggle'=>'tooltip','title'=>'logs per page','data-placement'=>'bottom']) !!}

                {!! Form::submit('show',['class' => 'btn btn-success mx-1']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/checkbox.mass.operation.js') }}" type="application/javascript"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
