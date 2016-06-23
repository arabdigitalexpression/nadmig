@extends('layouts.application')

@section('title'){{ getTitle($space->name) }}@endsection
@section('description'){{ getDescription($space) }}@endsection

@section('content')
    @if(count($space))
        <div class="page">
            <header class="post-header">
                <img class="logo" src="{{ url($space->logo) }}">
                <div class="name">
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
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $space->geo_location }}</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $space->phone_number }}</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $space->email }}"> {{ $space->email }}</a></li>
                        @foreach($space->links as $link)
                                @if($link->type == 'website')
                                <li><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{ $link->link }}">{{ $link->link }}</a></li>
                                @endif
                        @endforeach
                        <li>
                            @foreach($space->links as $link)
                                @if($link->type != 'website')
                                 <a href="{{ $link->link }}"><i class="fa fa-{{ $link->type }}" aria-hidden="true"></i></a>
                                @endif
                            @endforeach
                        </li>
                    </ul>
                </div>
                @if($space->status == 'working')
                <a class="btn btn-default btn-orange reserve" href="{{ route('reservation.create', ['organization_slug' => $space->organization['slug']])}}" role="button">{{ trans('Space::application.reserve') }}</a>
                @endif
            </header>
            <div class="post-excerpt">
                {!! $space->excerpt !!}
            </div>
            <div class="post-description">
                {!! $space->description !!}
            </div>
            <button type="button" class="btn btn-default more"><i class="fa fa-caret-down" aria-hidden="true"></i>{{trans('application.button.know_more')}}</button>
            <h3>{{ trans('Space::application.page.events') }}</h3>
            
        </div>
    @endif

    <script type="text/javascript">
        $(function(){
            $('.more').on("click", function(){
                if( $('.post-description').css("display") == "none" ){
                    $( this ).html('<i class="fa fa-caret-up" aria-hidden="true"></i>'+"{{trans('application.button.know_less')}}");
                    $('.post-description').show();
                }else{
                    $( this ).html('<i class="fa fa-caret-down" aria-hidden="true"></i>'+"{{trans('application.button.know_more')}}");
                    $('.post-description').hide();
                }
                 
            });
        });
    </script>
@endsection