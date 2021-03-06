@extends('layouts.application')

@section('title'){{ getTitle($permission) }}@endsection
@section('description'){{ getDescription($permission) }}@endsection

@section('content')
    @if(count($permission))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $permission->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $permission->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
