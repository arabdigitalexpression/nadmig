@extends('layouts.application')

@section('title'){{ getTitle('الفاعليات') }}@endsection

@section('content')
    @if(count($reservations))
        <form action="" class="form-inline filter">
             <div class="form-group">
                <label for="event_tags">نوع الفاعلية    : </label>
                <select multiple class="form-control chosen-select chosen-rtl">
                    @foreach($event_tags as $key => $type)
                        <option value="{{$key}}">{{$type}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="event_tags" class="event_tags">
            </div>
            <input type="submit" name="" class="btn-submit btn btn-success pull-left" value="رشح">
        </form>
        <ul class="spaces-list">
        @foreach($reservations as $reservation)
            <li class="panel panel-default panel-orange">
                <a href="{{ route('event.page', ['event_slug' => $reservation->event->slug ]) }}">
                    <div class="panel-heading">{{ $reservation->name }}</div>
                </a>   
                <div style="background-image: url({{ url($reservation->artwork) }});" class="space-icon"> </div>
                <ul class="space-info">
                    <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ ArabicDate($reservation->start_session['start_date']) }} </li>
                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> من {{ ArabicTime($reservation->start_session['start_time']) }}
                    <p>{{ str_limit($reservation->description, $limit = 100, $end = '...') }}</p>
                </ul>
                
            </li>
        @endforeach
        </ul>

        
    @else
        <center><h3 class="no-result">لا توجد فاعليات!</h3></center>
    @endif
    <ul class="pager">
            @php($meta = $reservations->toArray())
            @if($meta['prev_page_url'])
                <li class="previous"><a href="{{$meta['prev_page_url']}}">السابق <span aria-hidden="true">&larr;</span> </a></li>    
            @endif
            @if($meta['next_page_url'])
                <li class="next"><a href="{{$meta['next_page_url']}}"><span aria-hidden="true">&rarr;</span> التالي </a></li>
            @endif
         </ul>
     <script type="text/javascript">
        $(function(){
            var event_tags = "{!! Input::get('event_tags') !!}".split(",");
            event_tags.forEach(function(sq){
                if (sq != '') $('.chosen-select option[value='+sq+']').attr('selected','selected');
            })
            $('.filter').on('submit',function(e){
                e.preventDefault();
                var selMulti = $.map($(".chosen-select option:selected"), function (el, i) {
                    return $(el).val();
                });
                $('.event_tags').val(selMulti);
                e.currentTarget.submit();
            })
            $(".chosen-select").chosen({width: "auto", placeholder_text_multiple: "قم بأختيار نوع الفاعلية"});
        })
    </script>
     <style type="text/css">
        .chosen-container {
            min-width: 200px;
        }
    </style>
@endsection
