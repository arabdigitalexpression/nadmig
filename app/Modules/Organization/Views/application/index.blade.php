@extends('layouts.application')

@section('title'){{ getTitle($organization) }}@endsection
@section('description'){{ getDescription($organization) }}@endsection

@section('content')
    @if(count($organization))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $organization->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $organization->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
