@extends('layouts.application')

@section('title'){{ getTitle($organization->name) }}@endsection
@section('description'){{ getDescription($organization) }}@endsection

@section('content')
    @if(count($organization))
        <div class="page">
            <header class="post-header">
                <img class="logo" src="{{ url($organization->logo) }}">
                <div class="name">
                    <h3>{{ $organization->name }}</h3>
                    <ul class="info">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $organization->address }}</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $organization->phone_number }}</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $organization->email }}"> {{ $organization->email }}</a></li>
                        @foreach($organization->links as $link)
                                @if($link['type'] == 'website')
                                <li><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{ $link['link'] }}">{{ $link['link'] }}</a></li>
                                @endif
                        @endforeach
                        <li>
                            @foreach($organization->links as $link)
                                @if($link['type'] != 'website')
                                 <a href="{{ $link['link'] }}"><i class="fa fa-{{ $link['link'] }}" aria-hidden="true"></i></a>
                                @endif
                            @endforeach
                        </li>
                    </ul>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $organization->excerpt !!}
            </div>
            <div class="post-description">
                {!! $organization->description !!}
            </div>
            <button type="button" class="btn btn-default more"><i class="fa fa-caret-down" aria-hidden="true"></i>{{trans('application.button.know_more')}}</button>
            @if($organization->spaces->first())
                <h3>{{ trans('Organization::application.page.spaces') }}</h3>
                <ul class="spaces-list">
                    @foreach($organization->spaces as $space)
                        <li class="panel panel-default panel-orange">
                        <a href="{{ route('space.page', ['space_slug' => $space->slug ]) }}">
                            <div class="panel-heading">{{ $space->name }} <i style="
                                @if($space->status == 'working')
                                    color: #3cb878;
                                @elseif($space->status == 'stopped')
                                    color: #ed1c24;
                                @elseif($space->status == 'closed')
                                    color: #898989;
                                @endif
                                " class="fa fa-circle" aria-hidden="true"></i></div>
                        </a>   
                            <img src="{{ url($space->logo) }}" class="space-icon img-responsive">
                            <ul class="space-info">
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $space->address }}</li>
                                <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $space->phone_number }}</li>
                                <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $space->email }}"> {{ $space->email }}</a></li>
                                <li><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{ $space->website }}">{{ $space->website }}</a></li>
                            </ul>
                        
                    </li>
                    @endforeach
                </ul>
            @endif
            
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
