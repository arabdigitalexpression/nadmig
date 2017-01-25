@extends('layouts.application')

@section('title'){{ getTitle('المساحات') }}@endsection

@section('content')
    <form action="" class="form-inline filter">
        <div class="form-group pull-right">
            <label for="space_type">النوع: </label>
            <select multiple class="form-control chosen-select chosen-rtl space_type_choose">
                @foreach($space_type as $key => $type)
                    <option value="{{$key}}">{{$type}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group pull-right">
            <label for="expression"> </label>
            <select name="expression" class="form-control expression">
                <option value="or">إو</option>
                <option value="and">و</option>
            </select>
        </div>
         <div class="form-group pull-right">
            <label for="space_equipment">معدات: </label>
            <select multiple class="form-control chosen-select chosen-rtl space_equipmentـchoose">
                @foreach($space_equipment as $key => $type)
                    <option value="{{$key}}">{{$type}}</option>
                @endforeach
            </select>
            <input type="hidden" name="space_equipment" class="space_equipment">
            <input type="hidden" name="space_type" class="space_type">
        </div>
        <input type="submit" name="" class="btn-submit btn btn-success pull-right" style="font-family: FontAwesome;"  value="&#xf0b0 رشح">
    </form>
    @if(count($spaces))
        <ul class="spaces-list">
        @foreach($spaces as $space)
            <li class="panel panel-default panel-orange">
                <a href="{{ route('space.page', ['space_slug' => $space->slug ]) }}">
                    <div class="panel-heading">{{ $space->name }} <i style="
                        @if($space->status == 'working')
                            color: #3cb878;
                        @elseif($space->status == 'stopped')
                            color: #ed1c24;
                        @elseif($space->status == 'closed')
                            color: #898989;
                        @endif
                        " class="fa fa-circle" aria-hidden="true"></i></div>
                </a>  
                    <div style="background-image: url({{ url($space->logo) }});" class="space-icon"> </div> 
                    <ul class="space-info">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $space->address }}</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $space->phone_number }}</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $space->email }}"> {{ $space->email }}</a></li>
                    </ul>
                
            </li>
        @endforeach
        </ul>
    @else
        <center><h3 class="no-result">لا توجد مساحات!</h3></center>
    @endif
    <ul class="pager">
        @php($meta = $spaces->toArray())
        @if($meta['prev_page_url'])
            <li class="previous"><a href="{{$meta['prev_page_url']}}">السابق <span aria-hidden="true">&larr;</span> </a></li>    
        @endif
        @if($meta['next_page_url'])
            <li class="next"><a href="{{$meta['next_page_url']}}"><span aria-hidden="true">&rarr;</span> التالي </a></li>
        @endif
     </ul>
    <script type="text/javascript">
        $(function(){
            @if (Input::get('expression')) 
                $('.expression option[value={{Input::get('expression')}}]').attr('selected','selected');
            @endif
            var space_equipment = "{!! Input::get('space_equipment') !!}".split(",");
            var space_type = "{!! Input::get('space_type') !!}".split(",");
            space_equipment.forEach(function(sq){
                if (sq != '') $('.space_equipmentـchoose option[value='+sq+']').attr('selected','selected');
            })
            space_type.forEach(function(st){
                if (st != '') $('.space_type_choose option[value='+st+']').attr('selected','selected');
            })
            $('.filter').on('submit',function(e){
                e.preventDefault();
                var selMulti = $.map($(".space_equipmentـchoose option:selected"), function (el, i) {
                    return $(el).val();
                });
                var seltMulti = $.map($(".space_type_choose option:selected"), function (el, i) {
                    return $(el).val();
                });
                $('.space_equipment').val(selMulti.join());
                $('.space_type').val(seltMulti.join());
                e.currentTarget.submit();
            })
            $(".space_type_choose").chosen({width: "auto", placeholder_text_multiple: "قم بأختيار نوع المساحة"});
            $(".space_equipmentـchoose").chosen({width: "auto", placeholder_text_multiple: "قم بأختيار تجهيزات المساحة"});
            
        })
    </script>
    <style type="text/css">
        .chosen-container {
            min-width: 200px;
        }
    </style>
@endsection

