@extends('layouts.application')

@section('title'){{ getTitle($event) }}@endsection
@section('description'){{ getDescription($event) }}@endsection

@section('content')
    @if(count($event))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $event->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $event->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
