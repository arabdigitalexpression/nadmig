@extends('layouts.application')

@section('title'){{ getTitle($summerSchool) }}@endsection
@section('description'){{ getDescription($summerSchool) }}@endsection

@section('content')
    @if(count($summerSchool))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $summerSchool->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $summerSchool->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
