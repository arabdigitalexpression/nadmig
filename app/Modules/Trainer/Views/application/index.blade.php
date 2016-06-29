@extends('layouts.application')

@section('title'){{ getTitle($trainer) }}@endsection
@section('description'){{ getDescription($trainer) }}@endsection

@section('content')
    @if(count($trainer))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $trainer->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $trainer->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
