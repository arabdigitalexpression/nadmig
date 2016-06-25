@extends('layouts.application')

@section('title'){{ getTitle($event->reservation->name) }}@endsection

@section('content')
    @if(count($event))
         <div class="page">
            <header class="post-header">
                @if($event->reservation->artwork)
                    <img class="logo" src="{{ url($event->reservation->artwork) }}">
                @endif
                <div class="name">
                    <h3>{{ $event->reservation->name }}</h3>
                    
                    <ul class="info">
                        <li><i class="fa fa-building" aria-hidden="true"></i><a href="{{ route('organization.page', ['organization_slug' => $event->reservation->organization->slug ])}}">{{ $event->reservation->organization->name }}</a></li>
                        <li><i class="fa fa-users" aria-hidden="true"></i> {{ $event->reservation->group_name }}</li>
                        <li><i class="fa fa-user" aria-hidden="true"></i> {{ $event->reservation->facilitator_name }}</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $event->reservation->facilitator_email }}"> {{ $event->reservation->facilitator_email }}</a></li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $event->reservation->facilitator_phone }}</li>
                    </ul>
                </div>
                @if($event->reservation->apply)
                <div class="pull-left">
                        @if(Auth::check())
                            @if(count($event->apply) == 0)
                                @if(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::createFromFormat('d/m/Y', $event->reservation->apply_deadline), false) >= 0)
                                    <p class="text-muted" data-toggle="tooltip" data-placement="right" title="{{  ArabicDate(\Carbon\Carbon::createFromFormat('d/m/Y', $event->reservation->apply_deadline)->format('Y/m/d')) }}">
                                        {{ 'أخر موعد للتقديم بعد ' . \Carbon\Carbon::createFromFormat('d/m/Y', $event->reservation->apply_deadline)->diffForHumans(null, true) }}
                                    </p>
                                    <script type="text/javascript">
                                        $(function () {
                                          $('[data-toggle="tooltip"]').tooltip()
                                        })
                                    </script>
                                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">{{ trans('Event::application.apply.text') }}</h4>
                                            </div>
                                            <div class="modal-body">
                                               <h4>{{ trans('Event::application.apply.agreement') }}</h4>
                                               <p> {!! nl2br(e($event->reservation->apply_agreement)) !!} </p>
                                            </div>
                                            <div class="modal-footer">
                                                <a role="button" href="{{ route('event.apply', ['event_slug' => $event->slug ])}}" class="btn btn-default btn-primary reserve">{{ trans('Event::application.apply.text') }}</a>
                                              </div>
                                        </div>
                                      </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-green" data-toggle="modal" data-target=".bs-example-modal-lg">{{ trans('Event::application.apply.text') }} </button>  
                                    @if($event->reservation->apply_cost > 0)
                                        <i style="font-size: 13px;" class="fa fa-money" aria-hidden="true"></i>  {{ $event->reservation->apply_cost . ' جنيه' }}
                                    @else
                                        {{ 'مجانًا' }}
                                    @endif
                                @else
                                    <p class="text-muted">
                                        {{ 'إنتهى التقديم' }}
                                        </br>
                                        {{  ArabicDate(\Carbon\Carbon::createFromFormat('d/m/Y', $event->reservation->apply_deadline)->format('Y/m/d')) }}
                                    </p>
                                @endif
                            
                            @else
                                <p class="text-muted">
                                    {{ 'تم التقديم في ' }}
                                    </br>
                                    {{  ArabicDate($event->apply[0]->created_at->format('Y/m/d')) }}
                                    |
                                    {{  ArabicTime($event->apply[0]->created_at->format('h:i A')) }}
                                </p>
                            @endif
                        @else
                            <p class="text-muted">
                                {{ 'أخر موعد للتقديم ' }}
                                </br>
                                {{  ArabicDate(\Carbon\Carbon::createFromFormat('d/m/Y', $event->reservation->apply_deadline)->format('Y/m/d')) }}
                                </br>
                                

                            </p>
                            <button type="button" class="btn btn-primary btn-green" data-toggle="modal" data-target=".bs-example-modal-lg">{{ trans('Event::application.apply.text') }} </button>  
                            @if($event->reservation->apply_cost > 0)
                                <i style="font-size: 13px;" class="fa fa-money" aria-hidden="true"></i>  {{ $event->reservation->apply_cost . ' جنيه' }}
                            @else
                                {{ 'مجانًا' }}
                            @endif
                             <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">{{ trans('Event::application.apply.text') }}</h4>
                                    </div>
                                    <div class="modal-body">
                                       <h4>{{ trans('Event::application.apply.agreement') }}</h4>
                                       <p> {!! nl2br(e($event->reservation->apply_agreement)) !!} </p>
                                    </div>
                                    <div class="modal-footer">
                                        <a role="button" href="{{ route('auth.login')}}" class="btn btn-default btn-primary reserve">{{ trans('Event::application.apply.login.must') }}</a>
                                      </div>
                                </div>
                              </div>
                            </div>
                        @endif
                        </div>
                    @endif
            </header>
            <p>{{ $event->reservation->description }}</p>
            <h4>الجلسات</h4>
            <ul class="spaces-list">
            @foreach($event->reservation->sessions as $session)
                <li class="panel panel-default panel-orange">
                <a href="{{ route('session.show', ['session_slug' => $session['slug'], 'event_slug' => $event->slug ])}}">
                    <div class="panel-heading">{{ $session['name'] }}</div>
                </a>
                    <ul class="space-info">
                        <li><i class="fa fa-circle-o" aria-hidden="true"></i><a href="{{ route('space.page', ['space_slug' => $session['space']['slug'] ])}}"> {{ $session['space']['name'] }}</a></li>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($session['start_date']) }} </li>
                        <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($session['start_time']) }} إلى 
                        @if($session['period']->type == 'mins')
                            {{ ArabicTime(\Carbon\Carbon::createFromFormat('h:i a', $session['start_time'])->addMinutes(intval($session['period']->period))->format('h:i A')) }}</li>
                        @elseif($session['period']->type == 'hours')
                            {{ ArabicTime(\Carbon\Carbon::createFromFormat('h:i a', $session['start_time'])->addHours(intval($session['period']->period))->format('h:i A')) }}</li>
                        @endif
                        
                        <li>{!! $session['excerpt'] !!}</li>
                    </ul>
            </li>
            @endforeach
            </ul>
        </div>
    @endif
@endsection
