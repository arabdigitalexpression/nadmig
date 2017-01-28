@extends('layouts.application')

@section('title'){{ getTitle($space->name) }}@endsection
@section('description'){{ getDescription($space) }}@endsection

@section('content')
    @if(count($space))
        <div class="page">
            <header class="post-header row">
                <div class="col-md-3 col-md-push-9">
                    <img class="logo" src="{{ url($space->logo) }}">
                </div>
                <div class="name col-md-6 col-md-pull-3">
                    <h3>{{ $space->name }}<i style="
                        @if($space->status == 'working')
                            color: #3cb878;
                        @elseif($space->status == 'stopped')
                            color: #ed1c24;
                        @elseif($space->status == 'closed')
                            color: #898989;
                        @endif
                        " class="fa fa-circle" aria-hidden="true"></i>
                        
                    </h3>

                     <ul class="info">
                                <li><i class="fa fa-building" aria-hidden="true"></i><a href="{{ route('organization.page', ['organization_slug' => $space->organization->slug ])}}">{{ $space->organization->name }}</a></li>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $space->address }}</li>
                                <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $space->phone_number }}</li>
                                <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $space->email }}"> {{ $space->email }}</a></li>
                                @if($space->links)
                                    @foreach($space->links as $link)
                                            @if($link['type'] == 'website')
                                            <li><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{ $link['link'] }}">{{ $link['link'] }}</a></li>
                                            @endif
                                    @endforeach
                                    <li>
                                        @foreach($space->links as $link)
                                            @if($link['type'] != 'website')
                                             <a href="{{ $link['link'] }}"><i class="fa fa-{{ $link['link'] }}" aria-hidden="true"></i></a>
                                            @endif
                                        @endforeach
                                    </li>
                                @endif
                                @php($settings = unserialize(file_get_contents(base_path('./resources/settings.bin'))))
                                <li>
                                    @if(is_array($space->space_type))
                                        @foreach($space->space_type as $type)
                                                <a href="{{ route('spaces', ['space_type' => $type]) }}" class="space_type_tag btn btn-default">{{ $settings['space_type'][$type] }}</a>
                                        @endforeach
                                    @endif
                                </li>
                                <li>
                                    @if(is_array($space->space_equipment))
                                        @foreach($space->space_equipment as $equipment)
                                                <a href="{{ route('spaces', ['space_equipment' => $equipment]) }}" class="space_equipment_tag btn btn-default">{{ $settings['space_equipment'][$equipment] }}</a>
                                        @endforeach
                                    @endif
                                </li>
                            </ul>
                   
                </div>
                <div class="col-md-3 col-md-pull-3 pull-left">
                    @if($space->status == 'working' && Auth::user())
                        <a class="btn btn-default btn-orange reserve pull-left" href="{{ route('reservation.create', ['organization_slug' => $space->organization['slug']])}}" role="button">{{ trans('Space::application.reserve') }}</a>
                    @endif
                </div>
            </header>
            <div class="post-excerpt">
                {!! $space->excerpt !!}
            </div>
            <div class="post-description">
                {!! $space->description !!}
            </div>
            <button type="button" class="btn btn-default more"><i class="fa fa-caret-down pull-left" aria-hidden="true"></i>{{trans('application.button.know_more')}}</button>
            @if($space->organization->reservations)
            <h3>{{ trans('Space::application.page.events') }}</h3>
            <ul class="spaces-list">
                @foreach($space->organization->reservations->sortBy('start_date')->reverse() as $reservation)
                    @if($reservation->start_session)
                        <li class="panel panel-default panel-orange">
                            <a href="{{ route('event.page', ['event_slug' => $reservation->event->slug ]) }}">
                                <div class="panel-heading">{{ str_limit($reservation->name, $limit = 30, $end = '...') }}</div>
                            </a>   
                            <div style="background-image: url({{ url($reservation->artwork) }});" class="space-icon"> 
                            </div>
                            <ul class="space-info">
                                <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($reservation->start_session['start_date']) }} </li>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($reservation->start_session['start_time']) }}</li>
                                <li>{!! str_limit($reservation->description, $limit = 85, $end = '...') !!}</li>
                            </ul>
                        </li>
                    @endif
                @endforeach
                
            </ul>
            @endif
        </div>
    @endif

    <script type="text/javascript">
        $(function(){
            $('.more').on("click", function(){
                if( $('.post-description').css("display") == "none" ){
                    $( this ).html('<i class="fa fa-caret-up pull-left" aria-hidden="true"></i>'+"{{trans('application.button.know_less')}}");
                    $('.post-excerpt').hide();
                    $('.post-description').show();
                }else{
                    $( this ).html('<i class="fa fa-caret-down pull-left" aria-hidden="true"></i>'+"{{trans('application.button.know_more')}}");
                    $('.post-excerpt').show();
                    $('.post-description').hide();
                }
                 
            });
        });
    </script>
@endsection
