@extends('layouts.application')

@section('title'){{ getTitle($space->name) }}@endsection
@section('description'){{ getDescription($space) }}@endsection

@section('content')
    @if(count($space))
        <div class="space-page">
            <header class="post-header">
                <img class="space-logo" src="{{ url($space->logo) }}">
                <div class="space-name">
                    <h3>{{ $space->name }}<i style="
                        @if($space->status == 'working')
                            color: #3cb878;
                        @endif
                        " class="fa fa-circle" aria-hidden="true"></i>
                    </h3>
                    <ul class="space-info">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $space->geo_location }}</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $space->phone_number }}</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $space->email }}"> {{ $space->email }}</a></li>
                        <li><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{ $space->website }}">{{ $space->website }}</a></li>
                        <li>
                            @if($space->facebook)
                                <a href="{{ $space->facebook }}"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                            @endif
                            @if($space->twitter)
                                <a href="{{ $space->twitter }}"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                            @endif
                            @if($space->instagram)
                                <a href="{{ $space->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            @endif
                        </li>
                    </ul>
                </div>
                <a class="btn btn-default btn-orange space-reserve" href="{{ route('reservation.create', ['space_slug' => $space->slug])}}" role="button">{{ trans('Space::application.reserve') }}</a>
            </header>
            <div class="post-excerpt">
                {!! $space->excerpt !!}
            </div>
            <div class="post-description">
                {!! $space->description !!}
            </div>
            <button type="button" class="btn btn-default more"><i class="fa fa-caret-down" aria-hidden="true"></i>إعرف أكتر</button>
            <h3>{{ trans('Space::application.page.events') }}</h3>
            <ul class="spaces-list">
            @foreach($space->reservations as $reservation)
                <li class="panel panel-default panel-orange">
                    <a href="#">
                        <div class="panel-heading">{{ $reservation->name }}</div>
                    </a>   
                        <img src="{{ url($reservation->artwork) }}" class="space-icon img-responsive">
                        <ul class="space-info">
                            <li><i class="fa fa-envelope" aria-hidden="true"></i> {{ $reservation->facilitator_email }}</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $reservation->facilitator_phone }}</li>
                        </ul>

                    <div class="panel-heading time"><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate(json_decode($reservation->sessions[0]->start_time)->date) }} ، {{ ArabicTime(json_decode($reservation->sessions[0]->start_time)->time) }}</div>

                </li>
            @endforeach
            </ul>
        </div>
    @endif

    <script type="text/javascript">
        $(function(){
            $('.more').on("click", function(){
                if( $('.post-description').css("display") == "none" ){
                    $( this ).html('<i class="fa fa-caret-up" aria-hidden="true"></i>'+"إعرف أقل");
                    $('.post-description').show();
                }else{
                    $( this ).html('<i class="fa fa-caret-down" aria-hidden="true"></i>'+"إعرف أكتر");
                    $('.post-description').hide();
                }
                 
            });
        });
    </script>
@endsection
