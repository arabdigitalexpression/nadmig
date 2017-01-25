@extends('layouts.application')

@section('title'){{ getTitle() }}@endsection
@section('description'){{ getDescription() }}@endsection

@section('content')
	<h3>تحت رجليك</h3>
    <ul class="spaces-list">
    	@foreach ($reservations->take(4) as $reservation)
    		@if (isset($reservation)) 
                <li class="panel panel-default panel-orange">
                    <a href="{{ route('event.page', ['event_slug' => $reservation->event->slug ]) }}">
                        <div class="panel-heading">{{ str_limit($reservation->name, $limit = 30, $end = '...') }}</div>
                    </a>   
                    <div style="background-image: url({{ url($reservation->artwork) }});" class="space-icon"> </div>
                    <ul class="space-info">
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($reservation->start_session['start_date']) }} </li>
                        <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($reservation->start_session['start_time']) }}</li>
                        <li>{{ str_limit($reservation->description, $limit = 85, $end = '...') }}</li>
                    </ul>
                </li>
            @endif
    	@endforeach
        </ul>
        @if (count($reservations) > 4)
        {{-- @if (count($reservations)) --}}
            <h3>على مد الشوف <a class="pull-left btn btn-default" href="{{ route('events')}}">{{ trans('application.more') }} >></a></h3>
            <ul class="spaces-list-small">
                @foreach ($reservations->slice(4,null) as $index => $reservation)
                    {{-- @if ($index > 3)  --}}
                    @if (isset($reservation)) 
                        <li class="panel panel-default panel-orange">
                            <a href="{{ route('event.page', ['event_slug' => $reservation->event->slug ]) }}">
                                <div class="panel-heading">{{ str_limit($reservation->name, $limit = 30, $end = '...') }}</div>
                            </a>   
                            <div style="background-image: url({{ url($reservation->artwork) }});" class="space-icon"> </div>
                            <ul class="space-info">
                                <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($reservation->start_session['start_date']) }} </li>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($reservation->start_session['start_time']) }}
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif    
@endsection