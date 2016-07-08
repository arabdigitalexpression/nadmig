@extends('layouts.application')

@section('title'){{ getTitle($trainer->user->name) }}@endsection
@section('description'){{ getDescription($trainer) }}@endsection

@section('content')
    @if(count($trainer))
        <div class="page">
            <header class="post-header">
                <img class="logo" src="{{ url($trainer->user->picture) }}">
                <div class="name">
                    <h3>{{ $trainer->user->name }}</h3>
                    <ul class="info">
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $trainer->user->email }}"> {{ $trainer->user->email }}</a></li>
                        {{-- <li><i class="fa fa-birthday-cake" aria-hidden="true"></i>{{ ArabicDate(\Carbon\Carbon::createFromFormat('Y-m-d', $trainer->user->birthday)->format('Y/m/d')) }}</li> --}}

                        <li><i class="fa fa-map-marker" aria-hidden="true"></i>{{ GovArabic($trainer->user->governorate) }}</li>
                        @if($trainer->user->website)
                            <li><i class="fa fa-globe" aria-hidden="true"></i><a href="{{ $trainer->user->website }}">{{ $trainer->user->website }}</a></li>
                        @endif
                        <li>
                        @if($trainer->user->facebook)
                            <a href="{{ $trainer->user->facebook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        @endif
                        @if($trainer->user->twitter)
                            <a href="{{ $trainer->user->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        @endif
                        @if($trainer->user->instagram)
                            <a href="{{ $trainer->user->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        @endif
                        </li>
                        <li><i class="fa fa-rocket" aria-hidden="true"></i>{{ $trainer->specialization }}</li>
                        <li>{{ $trainer->bio }}</li>
                    </ul>
                    
                </div>
                @if(Auth::user()->id == $trainer->user_id)
                    <div class="pull-left">
                            <a style="font-size: 18px;" href="{{ route('application.trainer.edit', ['trainer_slug' => $trainer->slug]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                @endif
            </header>
             <ul class="spaces-list">
                @foreach($trainer->events as $event)
                    <li class="panel panel-default panel-orange">
                        <a href="{{ route('event.page', ['event_slug' => $event->slug ]) }}">
                            <div class="panel-heading">{{ $event->reservation->name }}</div>
                        </a>   
                            <img src="{{ url($event->reservation->artwork) }}" class="space-icon img-responsive">
                        <ul class="space-info">
                            <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($event->reservation->sessions[0]['start_date']) }} </li>
                            <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($event->reservation->sessions[0]['start_time']) }}
                            <li>{{ str_limit($event->reservation->description, $limit = 150, $end = '...') }}</li>
                        </ul>
                        @if(Auth::user()->id == $trainer->user_id)
                            <a href="{{ route('report.page', ['event_slug' => $event->slug ]) }}">
                                <div class="panel-footer">{{ trans('Trainer::application.trainer.report') }}</div>
                            </a> 
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
