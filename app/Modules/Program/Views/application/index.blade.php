@extends('layouts.application')

@section('title'){{ getTitle($program->name) }}@endsection
@section('description'){{ getDescription($program) }}@endsection

@section('content')
<div class="page program">
    @if(count($program))
                <header class="post-header">
                <div class="name">
                    <h3>{{ $program->name }}</h3>
                </div>
                @if($program->artwork)
                    <img class="logo" src="{{ url($program->artwork) }}">
                @endif
            </header>
            <div class="post-header">
                <p>{{ $program->description }}</p>
            </div>    
            <ul class="spaces-list">
                @foreach($program->events as $event)
                <li class="panel panel-default panel-orange">
                    <a href="{{ route('event.page', ['event_slug' => $event->slug ]) }}">
                        <div class="panel-heading">{{ str_limit($event->reservation->name, $limit = 85, $end = '...') }}</div>
                    </a>   
                        <img src="{{ url($event->reservation->artwork) }}" class="space-icon img-responsive">
                    <ul class="space-info">

                        <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($event->start_session['start_date']) }} </li>
                        <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($event->start_session['start_time']) }} إلى 
                        @if($event->start_session['period']->type == 'mins')
                            {{ ArabicTime(\Carbon\Carbon::createFromFormat('h:i a', $event->start_session['start_time'])->addMinutes(intval($event->start_session['period'])->period)->format('h:i A')) }}</li>
                        @elseif($event->start_session['period']->type == 'hours')
                            {{ ArabicTime(\Carbon\Carbon::createFromFormat('h:i a', $event->start_session['start_time'])->addHours(intval($event->start_session['period']->period))->format('h:i A')) }}</li>
                        @endif
                        
                        <li>{{ str_limit($event->reservation->description, $limit = 85, $end = '...') }}</li>
                    </ul>
                    
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
