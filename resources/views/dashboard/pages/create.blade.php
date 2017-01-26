@extends('layouts.admin')

@section('content')
    {!! form($form) !!}
    @include('partials.admin.tinymce')
    <script type="text/javascript">
    	editor_init("#content");
    </script>
@endsection