@extends('layouts.application')

@section('title'){{ getTitle('المساحات') }}@endsection

@section('content')
    @if(count($spaces))
        <ul class="spaces-list">
        @foreach($spaces as $space)
            <li class="panel panel-default panel-orange">
                <a href="{{ route('space.page', ['space_slug' => $space->slug ]) }}">
                    <div class="panel-heading">{{ $space->name }} <i style="
                        @if($space->status == 'working')
                            color: #3cb878;
                        @elseif($space->status == 'stopped')
                            color: #ed1c24;
                        @elseif($space->status == 'closed')
                            color: #898989;
                        @endif
                        " class="fa fa-circle" aria-hidden="true"></i></div>
                </a>  
                    <div style="background-image: url({{ url($space->logo) }});" class="space-icon"> </div> 
                    <ul class="space-info">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $space->address }}</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $space->phone_number }}</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $space->email }}"> {{ $space->email }}</a></li>
                    </ul>
                
            </li>
        @endforeach
        </ul>
    @endif
@endsection
