@extends('admin.layout.main')
@section('title')visit log ip: {{$visit->ip}} @endsection
@section('content')

    <div class="container">

        <h4>visit log ip: {{$visit->ip}} </h4>
        <p>
            @if($visit->position)
                <span> location:
                    @if($visit->position->countryName)
                        <img class="img-fluid" src="{{url('/').'/png/flags/'.
                                     $visit->position->countryCode.'.png'}}" alt="">
                        {{$visit->position->countryName}}
                    @else
                        <b><span class="text-danger">not found</span></b>
                    @endif
                </span>
            @else
                <b><span class="text-danger">not try</span></b>
            @endif
        </p>

        <table class="table table-responsive table-striped mt-4">
            <tr>
                <th>id:</th>
                <td>{{$visit->id}}</td>
            </tr>
            <tr>
                <th>method:</th>
                <td>{{$visit->method}}</td>
            </tr>
            <tr>
                <th>request:</th>
                <td>{{$visit->request}} </td>
            </tr>
            <tr>
                <th>url:</th>
                <td>{{$visit->url}} </td>
            </tr>
            <tr>
                <th>referer:</th>
                <td>{{$visit->referer}} </td>
            </tr>
            <tr>
                <th>languages:</th>
                <td>{{$visit->languages}} </td>
            </tr>
            <tr>
                <th>useragent:</th>
                <td>{{$visit->useragent}} </td>
            </tr>
            <tr>
                <th>headers:</th>
                <td>{{$visit->headers}} </td>
            </tr>
            <tr>
                <th>device:</th>
                <td>{{$visit->device}} </td>
            </tr>
            <tr>
                <th>platform:</th>
                <td>{{$visit->platform}} </td>
            </tr>
            <tr>
                <th>browser:</th>
                <td>{{$visit->browser}} </td>
            </tr>
            <tr>
                <th>user:</th>
                @if($visit->user)
                    <td>
                        <a href="{{route('users.edit', $visit->user->id)}}">
                            {{$visit->user->name}}</a>
                    </td>
                @else
                    <td><span class="text-success">guest</span></td>
                @endif
            </tr>
            <tr>
                <th>visitable:</th>
                @if($visit->visitable)
                    @if($visit->visitable_type == 'App\Post')
                        <td>post: <a href="{{route('posts.edit', $visit->visitable->id)}}">
                                {{$visit->visitable->title}}</a></td>
                    @elseif($visit->visitable_type == 'App\Cat')
                        <td>cat: <a href="{{route('categories.edit', $visit->visitable->id)}}">
                                {{$visit->visitable->title}}</a></td>
                    @endif
                @else
                    <td><span class="text-success">---</span></td>
                @endif
            </tr>
            <tr>
                <th>created at UTC:</th>
                <td>{{$visit->created_at}} <span
                        class="text-danger"> //</span> {{$visit->created_at->format('g:i a l jS F Y')}}</td>
            </tr>
            <tr>
                <th>created at Tehran Timezone:</th>
                <td>{{$visit->created_at->setTimezone('Asia/Tehran')}} <span class="text-danger"> //
                    </span> {{$visit->created_at->setTimezone('Asia/Tehran')->format('g:i a l jS F Y')}} </td>
            </tr>
            <tr>
                <th>diff For Humans:</th>
                <td>{{$visit->created_at->diffForHumans()}} </td>
            </tr>

            @if($visit->position)

                <tr>
                    <th>country Name:</th>
                    <td>
                        @if($visit->position->countryName)
                            <img class="img-fluid" src="{{url('/').'/png/flags/'.
                                     $visit->position->countryCode.'.png'}}" alt="">
                            {{$visit->position->countryName}}
                        @else
                            <b><span class="text-danger">not found</span></b>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>country Code:</th>
                    <td>{{$visit->position->countryCode}} </td>
                </tr>
                <tr>
                    <th>region Code:</th>
                    <td>{{$visit->position->regionCode}} </td>
                </tr>
                <tr>
                    <th>region Name:</th>
                    <td>{{$visit->position->regionName}} </td>
                </tr>
                <tr>
                    <th>city Name:</th>
                    <td>{{$visit->position->cityName}} </td>
                </tr>
                <tr>
                    <th>zip Code:</th>
                    <td>{{$visit->position->zipCode}} </td>
                </tr>
                <tr>
                    <th>iso Code:</th>
                    <td>{{$visit->position->isoCode}} </td>
                </tr>
                <tr>
                    <th>postal Code:</th>
                    <td>{{$visit->position->postalCode}} </td>
                </tr>
                <tr>
                    <th>latitude:</th>
                    <td>{{$visit->position->latitude}} </td>
                </tr>
                <tr>
                    <th>longitude:</th>
                    <td>{{$visit->position->longitude}} </td>
                </tr>
                <tr>
                    <th>metro Code:</th>
                    <td>{{$visit->position->metroCode}} </td>
                </tr>
                <tr>
                    <th>area Code:</th>
                    <td>{{$visit->position->areaCode}} </td>
                </tr>
                <tr>
                    <th>position driver:</th>
                    <td>{{$visit->position->driver}} </td>
                </tr>
            @endif
        </table>

    </div>


@endsection
