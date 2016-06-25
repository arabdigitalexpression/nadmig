@extends('layouts.application')

@section('title'){{ getTitle($apply) }}@endsection
@section('description'){{ getDescription($apply) }}@endsection

@section('content')
    @if(count($apply))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $apply->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $apply->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
