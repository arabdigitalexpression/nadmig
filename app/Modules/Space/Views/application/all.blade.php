@extends('layouts.application')

@section('title'){{ getTitle('المساحات') }}@endsection

@section('content')
    @if(count($spaces))
        <ul class="spaces-list">
        @foreach($spaces as $space)
            <li class="panel panel-default panel-orange">
                <a href="{{ route('space.page', ['space_slug' => $space->slug ]) }}">
                    <div class="panel-heading">{{ $space->name }}</div>
                    <div class="panel-body">
                    <img src="{{ url($space->logo) }}" class="img-responsive">
                    </div>
                </a>
            </li>
        @endforeach
        </ul>
    @endif
@endsection
