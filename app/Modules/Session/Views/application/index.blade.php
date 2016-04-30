@extends('layouts.application')

@section('title'){{ getTitle($session) }}@endsection
@section('description'){{ getDescription($session) }}@endsection

@section('content')
    @if(count($session))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $session->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $session->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
