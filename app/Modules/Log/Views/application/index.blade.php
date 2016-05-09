@extends('layouts.application')

@section('title'){{ getTitle($log) }}@endsection
@section('description'){{ getDescription($log) }}@endsection

@section('content')
    @if(count($log))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $log->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $log->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
