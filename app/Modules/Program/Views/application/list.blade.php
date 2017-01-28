@extends('layouts.application')

@section('title'){{ getTitle('الفاعليات') }}@endsection

@section('content')
    @if(count($programs))
        <ul class="spaces-list">
        @foreach($programs as $program)
            <li class="panel panel-default panel-orange full">
                <a href="{{ route('program.page', ['event_slug' => $program->slug ]) }}">
                    <div class="panel-heading">{{ str_limit($program->name, $limit = 30, $end = '...') }}</div>
                </a>   
                <div style="background-image: url({{ url($program->artwork) }});" class="space-icon"> </div>
                <ul class="space-info">

                    <li><i class="fa fa-calendar" aria-hidden="true"></i> من {{ ArabicDate($program->start_session['start_date']) }} </li>
                    <li> إلى {{ ArabicDate($program->end_session['start_date']) }} </li>
                    <li>{!! str_limit($program->description, $limit = 85, $end = '...') !!}</li>
                </ul>
                
            </li>
        @endforeach
        </ul>
    @else
        <center><h3 class="no-result">لا توجد برامج!</h3></center>
    @endif
    <ul class="pager">
            @php($meta = $programs->toArray())
            @if($meta['prev_page_url'])
                <li class="previous"><a href="{{$meta['prev_page_url']}}">السابق <span aria-hidden="true">&larr;</span> </a></li>    
            @endif
            @if($meta['next_page_url'])
                <li class="next"><a href="{{$meta['next_page_url']}}"><span aria-hidden="true">&rarr;</span> التالي </a></li>
            @endif
         </ul>
@endsection
