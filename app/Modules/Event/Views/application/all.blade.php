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
                <div style="background-image: url({{ url($event->reservation->artwork) }});" class="space-icon"> </div>
                <ul class="space-info">
                    <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($event->reservation->start_session['start_date']) }} </li>
                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($event->reservation->start_session['start_time']) }}
                    <li>{{ str_limit($event->reservation->description, $limit = 50, $end = '...') }}</li>
                </ul>
                
            </li>
        @endforeach
        </ul>
    @endif
@endsection
