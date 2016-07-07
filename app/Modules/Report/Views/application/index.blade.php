@extends('layouts.application')

@section('title'){{ getTitle("تقارير") }}@endsection

@section('content')
    @if(count($event))
        <div class="page">
            @if($count > 0)
                @for ($i = 1; $i < $count+1; $i++)
                     <div class="panel panel-default week">
                      <div class="panel-heading">
                        <h3 class="panel-title">الأسبوع {{ $i }}</h3>
                      </div>
                      <div class="panel-body">
                        @foreach($event->attendees as $kid)
                            @if(is_null(\App\Modules\Report\Models\TrainerReport::where('event_id', $event->id)->where('week', $i)->where('attendees_id', $kid->id)->first()))
                                <a href="{{ route('report.page.event', ['event_slug' => $event->slug, 'week' => $i, 'attendees_id' => $kid->id])}}">
                                  <img class="img-responsive user-thumbnail" src="{{ url('/files/pp.png') }}"> 
                                  <span>{{ $kid->name }}</span> 
                                </a>
                            @else
                                <a href="{{ route('report.page.event.show', ['event_slug' => $event->slug, 'week' => $i, 'attendees_id' => $kid->id])}}">
                                  <img class="img-responsive user-thumbnail" src="{{ url('/files/pp.png') }}"> 
                                  <i style="color:#39b54a;" class="fa fa-check" aria-hidden="true">{{ $kid->name }}</i>
                                </a>
                            @endif
                        @endforeach
                      </div>
                    </div>    
                @endfor
            @else
                <h3>لا توجد تقارير بعد</h3>
            @endif
        </div>
    @endif
@endsection
