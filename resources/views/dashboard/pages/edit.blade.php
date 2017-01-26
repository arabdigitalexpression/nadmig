@extends('layouts.admin')

@section('content')
    {!! form($form) !!}
    <script src="{{ url( 'packages/tinymce/tinymce.min.js' ) }}" type="text/javascript"></script>
    <script type="text/javascript">
    	editor_init("#content");
    </script>
@endsection