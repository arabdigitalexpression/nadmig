@extends('layouts.application')

@section('title'){{ $page->title }}@endsection

@section('content')
    @if(count($page))
        <div>
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $page->title }}
                    @if (Auth::user() && Auth::user()->hasRole('admin'))
                        <a href="{{ route('dashboard.page.edit', ['page' => $page->id])}}" class="pull-left">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endif
                    </h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $page->content !!}
            </div>
        </div>
    @endif
@endsection