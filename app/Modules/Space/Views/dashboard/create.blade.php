@extends('layouts.admin')

@section('content')
    {!! form($form) !!}
    @include('partials.admin.tinymce')
    <script type="text/javascript">
		$(function(){
			$('#in_return_key').change( function() {
				if ($('#in_return_key option:selected').val() == "free" || $('#in_return_key option:selected').val() == "any") {
					$('#in_return').attr('type', 'hidden');
				}else{
					$('#in_return').attr('type', 'number');
				}
			});
			$(".chosen-select").chosen({width: "100%", placeholder_text_multiple: "قم بأختيار تجهيزات المساحة"});
		});
	</script>
@endsection
