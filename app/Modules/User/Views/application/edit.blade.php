@extends('layouts.application')

@section('title'){{ getTitle($extra->name) }}@endsection


@section('content')
    <div class="page">
     {!! form($form) !!}
     <script type="text/javascript">
     	$(function(){
     		$('input[type=email').attr('disabled', true);
     		$('#birthday').pickadate({
                format: 'yyyy-mm-dd',
                min: [1940,1,1],
                max: new Date(),
                selectYears: 75,
                selectMonths: true
            });
     	})
     </script>
     </div>
@endsection
