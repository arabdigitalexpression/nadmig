@extends('layouts.application')

@section('title'){{ getTitle('الفاعليات') }}@endsection

@section('content')
    @if(count($programs))
        <ul class="spaces-list">
        @foreach($programs as $program)
            <li class="panel panel-default panel-orange full">
                <a href="{{ route('program.page', ['event_slug' => $program->slug ]) }}">
                    <div class="panel-heading">{{ $program->name }}</div>
                </a>   
                    <img src="{{ url($program->artwork) }}" class="space-icon img-responsive">
                <ul class="space-info">

                    <li><i class="fa fa-calendar" aria-hidden="true"></i> من {{ ArabicDate($program->start_session['start_date']) }} </li>
                    <li> إلى {{ ArabicDate($program->end_session['start_date']) }} </li>
                    <li>{{ str_limit($program->description, $limit = 150, $end = '...') }}</li>
                </ul>
                
            </li>
        @endforeach
        </ul>
    @endif
@endsection
