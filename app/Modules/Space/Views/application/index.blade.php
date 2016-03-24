@extends('layouts.application')

@section('title'){{ getTitle($space) }}@endsection
@section('description'){{ getDescription($space) }}@endsection

@section('content')
    @if(count($space))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $space->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $space->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
