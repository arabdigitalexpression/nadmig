@extends('layouts.application')

@section('title'){{ getTitle($session->name) }}@endsection


@section('content')
    @if(count($session))
        <dive class="page">
            <header class="post-header">
                <div class="name">
                    <h3>{{ $session->name }} 
                    @if(Auth::check())
                        @if($session->status == "pending")
                            <i style="color:#898989; font-size: 20px;" class="fa fa-cog" aria-hidden="true"></i>
                        @elseif($session->status == "accepted")
                            <i style="color:#39b54a; font-size: 20px;" class="fa fa-check" aria-hidden="true"></i>
                        @endif
                    @endif
                    </h3>
                
                 <ul class="info">
                    <li><i class="fa fa-book" aria-hidden="true"></i><a href="{{ route('application.reservation.index', ['reservation_url_id' => $session->reservation->url_id ])}}"> {{ $session->reservation->name }}</a></li>
                    <li><i class="fa fa-circle-o" aria-hidden="true"></i><a href="{{ route('space.page', ['space_slug' => $session->space->slug ])}}"> {{ $session->space->name }}</a></li>
                    <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($session->start_date) }} </li>
                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($session->start_time) }} إلى 
                    @if($session->period->type == 'mins')
                        {{ ArabicTime(\Carbon\Carbon::createFromFormat('h:i a', $session->start_time)->addMinutes(intval($session->period->period))->format('h:i A')) }}</li>
                    @elseif($session->period->type == 'hours')
                        {{ ArabicTime(\Carbon\Carbon::createFromFormat('h:i a', $session->start_time)->addHours(intval($session->period->period))->format('h:i A')) }}</li>
                    @endif
                </ul>
                </div>
                 <div class="pull-left">
                @if(Auth::check() && (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id'] == $session->reservation->organization_id) || (Auth::user()->hasRole('space_manager') && Auth::user()->manageSpace['id'] == $session->space_id)) )
                    @if($session->status != "accepted")
                        <a href="{{ route('session.accept', ['session_slug' => $session->slug ])}}"> <i style="color:#39b54a; font-size: 16px;" class="fa fa-check" aria-hidden="true"> الموافقة </i></a>
                    @endif
                @endif
                <a class="btn btn-default" href="{{ route('event.page', ['event_slug' => $session->reservation->event->slug]) }}">{{ 'الرجوع للفاعلية ' }}<i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $session->description !!}
            </div>
        </dive>
    @endif
@endsection
