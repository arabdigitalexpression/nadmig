@extends('layouts.admin')

@section('content')
    {!! form($form) !!}
    <script type="text/javascript">
    	$(".chosen-select").chosen({width: "100%", placeholder_text_multiple:  "الاورش التى درب بيها المدرب"});
    </script>
@endsection
