@extends('layouts.application')

@section('title'){{ getTitle($organization->name) }}@endsection
@section('description'){{ getDescription($organization) }}@endsection

@section('content')
    @if(count($organization))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $organization->name }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $organization->content !!}
            </div>
        </article>
    @endif
@endsection
