@extends('layouts.application')

@section('title'){{ getTitle($school) }}@endsection
@section('description'){{ getDescription($school) }}@endsection

@section('content')
    @if(count($school))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $school->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $school->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
