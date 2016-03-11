@extends('layouts.application')

@section('title'){{ getTitle($user) }}@endsection
@section('description'){{ getDescription($user) }}@endsection

@section('content')
    @if(count($user))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $user->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $user->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
