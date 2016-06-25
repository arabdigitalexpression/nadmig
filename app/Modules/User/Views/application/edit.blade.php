@extends('layouts.application')

@section('title'){{ getTitle($extra->name) }}@endsection


@section('content')
     {!! form($form) !!}
     <script type="text/javascript">
     	$(function(){
     		$('input[type=email').attr('disabled', true)
     	})
     </script>
@endsection
