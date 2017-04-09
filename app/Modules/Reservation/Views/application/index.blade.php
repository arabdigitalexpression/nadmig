@extends('layouts.application')

@section('title'){{ getTitle($reservation->name) }}@endsection

@section('content')
    @if(count($reservation))
        <div class="page">
            <header class="post-header">
                @if($reservation->artwork)
                    <img class="logo" src="{{ url($reservation->artwork) }}">
                @endif
                <div class="name">
                    <h3>{{ $reservation->name }}
                        @if($reservation->status == "pending")
                            <i style="color:#898989; font-size: 20px;" class="fa fa-cog" aria-hidden="true"></i>
                        @endif
                        @if($reservation->status == "accepted")
                            <i style="color:#39b54a; font-size: 20px;" class="fa fa-check" aria-hidden="true"></i>
                        @endif
                        @if($reservation->status == "deleted")
                            <i style="color:#D0021B; font-size: 20px;" class="fa fa-trash" aria-hidden="true"></i>
                        @endif
                    </h3>
                    <ul class="info">
                        <li><i class="fa fa-building" aria-hidden="true"></i><a href="{{ route('organization.page', ['organization_slug' => $reservation->organization->slug ])}}">{{ $reservation->organization->name }}</a></li>
                        <li><i class="fa fa-users" aria-hidden="true"></i> {{ $reservation->group_name }}</li>
                        <li><i class="fa fa-user" aria-hidden="true"></i> {{ $reservation->facilitator_name }}</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $reservation->facilitator_email }}"> {{ $reservation->facilitator_email }}</a></li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $reservation->facilitator_phone }}</li>
                    </ul>
                </div>
                <div class="pull-left">
                @if(Auth::check() && $reservation->status != 'accepted' && (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id'] == $reservation->organization_id)))
                    <a href="{{ route('application.reservation.accept', ['reservation_url_id' => $reservation->url_id ])}}"> <i style="color:#39b54a; font-size: 16px;" class="fa fa-check" aria-hidden="true"> الموافقة </i></a> 
                @endif
                @if(Auth::check() && (Auth::user()->hasRole('admin') || (Auth::user()->id == $reservation->user_id)))
                    <a href="{{ route('application.reservation.edit', ['reservation_url_id' => $reservation->url_id ])}}"> <i style="color:#898989; font-size: 16px;" class="fa fa-pencil" aria-hidden="true"> تعديل </i></a>
                @endif
                @if(Auth::check() && $reservation->status == 'accepted' && ((Auth::user()->hasRole('admin') || (Auth::user()->manageOrganization['id'] == $reservation->organization_id))) )
                    <a href="{{ route('application.reservation.del', ['reservation_url_id' => $reservation->url_id ])}}"> <i style="color:#D0021B; font-size: 16px;" class="fa fa-trash" aria-hidden="true"></i></a>
                @endif
                </div>
            </header>
            <p>{!! $reservation->description !!}</p>
            <div class="row">

              <div class="col-md-4">
                    <h4>تفاصيل أخرى</h4>
                    <ul>
                        <h5><strong>السن</strong> : {{ getGroupAge($reservation->group_age) }}</h4>
                        <h5><strong>أقصى عدد الحضور</strong> : {{ $reservation->max_attendees }}</h4>
                        <h5><strong>عدد الحضور المتوقع</strong> : {{ $reservation->expected_attendees }}</h4>
                        <h5><strong>عدد المحجوز مسبقًا</strong> : {{ $reservation->reserved_attendees }}</h4>
                        <h5><strong>نوع الحجز</strong> : {{ getEventtype($reservation->event_type) }}</h4>
                        @if($reservation->dooropen_time->type != "null")
                            <h5><strong>فتح الأبواب لأستقبال الجمهور</strong> : قبل بداية الورشة بـ {{ ArabicPeriod($reservation->dooropen_time) }}</h4>
                        @endif
                        @if($reservation->dooropen_period->type != "null")
                            <h5><strong>موعد غلق الأبواب</strong> : بعد بداية الورشة بـ {{ ArabicPeriod($reservation->dooropen_period) }}</h4>
                        @endif
                    </ul>
                    
              </div>
             
              <div class="col-md-4">
                  @if($reservation->apply)
                    <h4>الإشتراكات</h4>
                        <ul>
                            <h5><strong>قيمة التقديم</strong> : {{ $reservation->apply_cost }}</h4>
                            <h5><strong>أخر موعد للتقديم</strong> : {{ $reservation->apply_deadline }}</h4>
                            <h5><strong>اتفاق التقديم</strong> : </h4> <p> {!! nl2br(e($reservation->apply_agreement)) !!} </p>
                        </ul>
                    @endif
              </div>
              <div class="col-md-4">
                    <h4>مسؤول الحجز</h4>
                    <ul>
                        <h5><strong>الاسم</strong> : {{ $reservation->facilitator_name }}</h5>
                        <h5><strong>الإيميل</strong> : {{ $reservation->facilitator_email }}</h5>
                        <h5><strong>الهاتف</strong> : {{ $reservation->facilitator_phone }}</h5>
                    </ul>
              </div>
            </div>
                

                    
            <h4>الجلسات</h4>
            <ul class="spaces-list sessions-list">
            @foreach($reservation->sessions as $session)
                <li class="panel panel-default panel-orange">
                <a href="{{ route('session.page', ['session_slug' => $session->slug ])}}">
                    <div class="panel-heading">{{ $session->name }} 
                    @if($session->status == "pending")
                        <i style="color:#898989;" class="fa fa-cog" aria-hidden="true"></i>
                    @endif
                    @if($session->status == "accepted")
                        <i style="color:#39b54a;" class="fa fa-check" aria-hidden="true"></i>
                    @endif
                    </div>
                    </a>
                    <ul class="space-info">
                        <li><i class="fa fa-circle-o" aria-hidden="true"></i><a href="{{ route('space.page', ['space_slug' => $session->space->slug ])}}"> {{ $session->space->name }}</a></li>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($session->start_date) }} </li>
                        <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($session->start_time) }} إلى 
                        @if($session->period->type == 'mins')
                            {{ ArabicTime(\Carbon\Carbon::createFromFormat('h:i a', $session->start_time)->addMinutes(intval($session->period->period))->format('h:i A')) }}</li>
                        @elseif($session->period->type == 'hours')
                            {{ ArabicTime(\Carbon\Carbon::createFromFormat('h:i a', $session->start_time)->addHours(intval($session->period->period))->format('h:i A')) }}</li>
                        @endif
                        
                        <li>{!! $session->excerpt !!}</li>
                    </ul>
            </li>
            @endforeach
            </ul>
        </div>
    @endif
@endsection
