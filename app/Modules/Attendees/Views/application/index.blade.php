@extends('layouts.application')

@section('title'){{ getTitle($attendees) }}@endsection
@section('description'){{ getDescription($attendees) }}@endsection

@section('content')
    @if(count($attendees))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $attendees->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $attendees->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
