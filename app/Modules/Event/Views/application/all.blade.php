@extends('layouts.application')

@section('title'){{ getTitle('الفاعليات') }}@endsection

@section('content')
    @if(count($events))
        <ul class="spaces-list">
        @foreach($events as $event)
            <li class="panel panel-default panel-orange">
                <a href="{{ route('event.page', ['event_slug' => $event->slug ]) }}">
                    <div class="panel-heading">{{ $event->reservation->name }}</div>
                </a>   
                    <img src="{{ url($event->reservation->artwork) }}" class="space-icon img-responsive">
                <ul class="space-info">

                    <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($event->reservation->start_session['start_date']) }} </li>
                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($event->reservation->start_session['start_time']) }} إلى 
                    @if($event->reservation->start_session['period']->type == 'mins')
                        {{ ArabicTime(\Carbon\Carbon::createFromFormat('h:i a', $event->reservation->start_session['start_time'])->addMinutes(intval($event->reservation->start_session['period']->period))->format('h:i A')) }}</li>
                    @elseif($event->reservation->start_session['period']->type == 'hours')
                        {{ ArabicTime(\Carbon\Carbon::createFromFormat('h:i a', $event->reservation->start_session['start_time'])->addHours(intval($event->reservation->start_session['period']->period))->format('h:i A')) }}</li>
                    @endif
                    
                    <li>{{ str_limit($event->reservation->description, $limit = 150, $end = '...') }}</li>
                </ul>
                
            </li>
        @endforeach
        </ul>
    @endif
@endsection
