@extends('layouts.application')

@section('title'){{ getTitle($program) }}@endsection
@section('description'){{ getDescription($program) }}@endsection

@section('content')
    @if(count($program))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $program->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $program->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
