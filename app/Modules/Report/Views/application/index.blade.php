@extends('layouts.application')

@section('title'){{ getTitle($report) }}@endsection
@section('description'){{ getDescription($report) }}@endsection

@section('content')
    @if(count($report))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $report->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $report->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
