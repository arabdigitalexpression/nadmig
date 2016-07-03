@extends('layouts.admin')

@section('content')
    {!! form($form) !!}
    @include('partials.admin.tinymce')
    <script type="text/javascript">
    	$(".chosen-select").chosen({width: "100%", placeholder_text_multiple: "قم بأختيار الفتية المشتركين بالمدرسة"});
    </script>
@endsection
