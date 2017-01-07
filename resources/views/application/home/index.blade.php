@extends('layouts.application')

@section('title'){{ getTitle() }}@endsection
@section('description'){{ getDescription() }}@endsection

@section('content')
	<h3>تحت رجليك</h3>
    <ul class="spaces-list">
    	@for ($i = 0; $i < 4; $i++)
    		@if (isset($reservations[$i])) 
                @php($reservation = $reservations[$i])
                <li class="panel panel-default panel-orange">
                    <a href="{{ route('event.page', ['event_slug' => $reservation->event->slug ]) }}">
                        <div class="panel-heading">{{ $reservation->name }}</div>
                    </a>   
                    <div style="background-image: url({{ url($reservation->artwork) }});" class="space-icon"> </div>
                    <ul class="space-info">
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($reservation->start_session['start_date']) }} </li>
                        <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($reservation->start_session['start_time']) }}
                        <p>{{ str_limit($reservation->description, $limit = 100, $end = '...') }}</p>
                    </ul>
                </li>
            @endif
    	@endfor
        </ul>
    	<h3>على مد الشوف</h3>
        <ul class="spaces-list-small">
        	@for ($i = 4; $i < count($reservations); $i++)
                @if (isset($reservations[$i])) 
            		@php($reservation = $reservations[$i])
            	    <li class="panel panel-default panel-orange">
                        <a href="{{ route('event.page', ['event_slug' => $reservation->event->slug ]) }}">
                            <div class="panel-heading">{{ $reservation->name }}</div>
                        </a>   
                        <div style="background-image: url({{ url($reservation->artwork) }});" class="space-icon"> </div>
                        <ul class="space-info">
                            <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($reservation->start_session['start_date']) }} </li>
                            <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($reservation->start_session['start_time']) }}
                        </ul>
                    </li>
                @endif
        	@endfor
        </ul>
@endsection