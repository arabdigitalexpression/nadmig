@extends('layouts.admin', ['no_boxes' => true])

@section('content')
    <section class="content">
        <div class="row">
            {!! dashboard_box("bg-aqua", "circle-o",
                trans('dashboard.fields.dashboard.spaces'), count($data['spaces'])) !!}
            
        </div>
       

    </section>


    <script src="{{ url('js/raphael.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   
@endsection