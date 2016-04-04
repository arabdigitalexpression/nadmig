@extends('layouts.application')

@section('title'){{ getTitle($reservation) }}@endsection
@section('description'){{ getDescription($reservation) }}@endsection

@section('content')
    @if(count($reservation))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $reservation->name }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $reservation->excerpt !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
