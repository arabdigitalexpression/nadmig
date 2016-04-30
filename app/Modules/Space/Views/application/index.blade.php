@extends('layouts.application')

@section('title'){{ getTitle($space->name) }}@endsection
@section('description'){{ getDescription($space) }}@endsection

@section('content')
    @if(count($space))
            <header class="post-header">
                <img class="space-logo" src="{{ url($space->logo) }}">
                <div class="space-name">
                    <h3>{{ $space->name }}<i style="
                        @if($space->status == 'working')
                            color: #3cb878;
                        @endif
                        " class="fa fa-circle" aria-hidden="true"></i>
                    </h3>
                </div>
                <a class="btn btn-default btn-orange space-reserve" href="{{ route('reservation.create', ['space_slug' => $space->slug])}}" role="button">{{ trans('Space::application.reserve') }}</a>
            </header>
            <div class="post-excerpt">
                {!! $space->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
    @endif
@endsection
