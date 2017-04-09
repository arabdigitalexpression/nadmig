@extends('layouts.application')

@section('title'){{ getTitle($event->reservation->name) }}@endsection

@section('content')
    @if(count($event))
         <div class="page">
            <header class="post-header row">
                <div class="col-md-3 col-md-push-9">
                    @if($event->reservation->artwork)
                        <img class="logo" src="{{ url($event->reservation->artwork) }}">
                    @endif
                </div>
                
                <div class="name col-md-6 col-md-pull-3">
                    <h3>{{ $event->reservation->name }}</h3>
                    
                    <ul class="info">
                        <li><i class="fa fa-building" aria-hidden="true"></i><a href="{{ route('organization.page', ['organization_slug' => $event->reservation->organization->slug ])}}">{{ $event->reservation->organization->name }}</a></li>
                        <li><i class="fa fa-users" aria-hidden="true"></i> {{ $event->reservation->group_name }}</li>
                        <li><i class="fa fa-user" aria-hidden="true"></i> {{ $event->reservation->facilitator_name }}</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $event->reservation->facilitator_email }}"> {{ $event->reservation->facilitator_email }}</a></li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $event->reservation->facilitator_phone }}</li>
                        <li>
                            @php($settings = unserialize(file_get_contents(base_path('./resources/settings.bin'))))
                            @if ($event->reservation->event_tags)
                                @foreach ($event->reservation->event_tags as $tag)
                                    <a href="{{ route('spaces', ['event_tags' => $tag]) }}" class="space_type_tag btn btn-default">{{ $settings['event_tags'][$tag] }}</a>
                                @endforeach
                            @endif
                        </li>
                    </ul>
                </div>
                
                <div class="col-md-3 col-md-pull-3 pull-left">
                    <div class="addthis_inline_share_toolbox"></div>
                    @if($event->reservation->apply)
                        @if(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::createFromFormat('d/m/Y', $event->reservation->apply_deadline), false) >= 0)
                            <p class="text-muted" data-toggle="tooltip" data-placement="right" title="{{  ArabicDate(\Carbon\Carbon::createFromFormat('d/m/Y', $event->reservation->apply_deadline)->format('Y/m/d')) }}">
                                {{ 'أخر موعد للتقديم بعد ' . \Carbon\Carbon::createFromFormat('d/m/Y', $event->reservation->apply_deadline)->diffForHumans(null, true) }}
                                </br>
                                <button type="button" class="btn btn-primary btn-green" data-toggle="modal" data-target=".bs-example-modal-lg">{{ trans('Event::application.apply.text') }} </button>  
                                @if($event->reservation->apply_cost > 0)
                                    <i style="font-size: 13px; color: #000;" class="fa fa-money" aria-hidden="true"></i>  <span style="color:#000;">{{ $event->reservation->apply_cost . ' جنيه' }}</span>
                                @else
                                    <span style="color:#000;">{{ 'مجانًا' }}</span>
                                @endif
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
                                        <h4 class="modal-title" id="myModalLabel">{{ trans('Event::application.apply.text') }} <span class="apply_deadline"> أخر موعد للتقديم {{  ArabicDate(\Carbon\Carbon::createFromFormat('d/m/Y', $event->reservation->apply_deadline)->format('Y/m/d')) }}</span></h4>
                                    </div>
                                    <div class="modal-body">
                                       <h4>{{ trans('Event::application.apply.agreement') }}</h4>
                                       <p> {!! nl2br(e($event->reservation->apply_agreement)) !!} </p>
                                       @if($event->reservation->apply_link)
                                            <iframe class="apply_link_frame" src="{{$event->reservation->apply_link}}"></iframe>
                                       @endif
                                    </div>
                                    {{-- <div class="modal-footer">
                                        <a role="button" href="{{ route('event.apply', ['event_slug' => $event->slug ])}}" class="btn btn-default btn-primary reserve">{{ trans('Event::application.apply.text') }}</a>
                                      </div> --}}

                                </div>
                              </div>
                            
                        @else
                            <p class="text-muted">
                                {{ 'إنتهى التقديم' }}
                                </br>
                                {{  ArabicDate(\Carbon\Carbon::createFromFormat('d/m/Y', $event->reservation->apply_deadline)->format('Y/m/d')) }}
                            </p>
                        @endif
                  @endif  
                  </div>
            </header>
            <div class="row">
                <div class="col-lg-12 pull-right">
                    <p>{!! $event->reservation->description !!}</p>
                </div>
            </div>
            <h4>الجلسات</h4>
            <ul class="spaces-list sessions-list">
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

