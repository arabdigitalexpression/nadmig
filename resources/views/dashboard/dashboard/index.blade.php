@extends('layouts.admin', ['no_boxes' => true])

@section('content')
    <section class="content">
        <div class="row">
        	@if($data)
            {!! dashboard_box("bg-aqua", "circle-o",
                trans('dashboard.fields.dashboard.spaces'), count($data['spaces'])) !!}
            @else
            	<h3>لوحة التحكم</h3>
            @endif

        </div>
       

    </section>


    <script src="{{ url('js/raphael.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   
@endsection