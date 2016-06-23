@extends('layouts.application')

@section('title'){{ getTitle($session->name) }}@endsection


@section('content')
    @if(count($session))
        <dive class="page">
            <header class="post-header">
                <div class="name">
                    <h3>{{ $session->name }} 
                    @if($session->status == "pending")
                        <i style="color:#898989; font-size: 20px;" class="fa fa-cog" aria-hidden="true"></i>
                    @endif
                    @if($session->status == "accepted")
                        <i style="color:#39b54a; font-size: 20px;" class="fa fa-check" aria-hidden="true"></i>
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
                @if(Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id'] == $session->reservation->organization_id) || (Auth::user()->hasRole('space_manager') && Auth::user()->manageSpace['id'] == $session->space_id) )
                    <a href="{{ route('session.accept', ['session_slug' => $session->slug ])}}"> <i style="color:#39b54a; font-size: 16px;" class="fa fa-check" aria-hidden="true"> الموافقة </i></a> 
                @endif
                </div>
            </header>
            <div class="post-excerpt">
                {!! $session->description !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </dive>
    @endif
@endsection
