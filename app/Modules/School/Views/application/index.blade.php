@extends('layouts.application')

@section('title'){{ getTitle('المدارس الصيقية') }}@endsection

@section('content')
    @if(count($schools))
        <ul class="spaces-list">
        @foreach($schools as $school)
            <li class="panel panel-default panel-orange full">
                <a href="{{ route('program.page', ['event_slug' => $school->program->slug ]) }}">
                    <div class="panel-heading">{{ $school->program->name }}</div>
                </a>   
                <div style="background-image: url({{ url($school->program->artwork) }});" class="space-icon"> </div>
                <ul class="space-info">
{{-- 
                    <li><i class="fa fa-calendar" aria-hidden="true"></i> من {{ ArabicDate($school->program->start_session['start_date']) }} </li>
                    <li> إلى {{ ArabicDate($school->program->end_session['start_date']) }} </li> --}}
                    <li><i class="fa fa-building" aria-hidden="true"></i> {{ $school->organization->name }}</li>
                    <li>{{ str_limit($school->program->description, $limit = 150, $end = '...') }}</li>
                </ul>
                
            </li>
        @endforeach
        </ul>
    @endif
@endsection
