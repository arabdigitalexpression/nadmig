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
			$('input[type=\'radio\']').change( function() {
				var id = $(this).attr('name').replace("[type]", ""); 
				if ($('input[name="'+$(this).attr('name')+'"]:checked').val() == "null") {
					$('#'+id+'_period').attr('type', 'hidden');
				}else{
					$('#'+id+'_period').attr('type', 'number');
				}
			});
			$('input[type=\'radio\']').change( function() {
				var id = $(this).attr('name').replace("[type]", ""); 
				if ($('input[name="'+$(this).attr('name')+'"]:checked').val() == "null") {
					$('#'+id).attr('type', 'hidden');
				}else{
					$('#'+id).attr('type', 'number');
				}
			});
			$(".chosen-select").chosen({width: "100%", placeholder_text_multiple: "قم بأختيار تجهيزات المساحة"});
			var weekdays = ['sat', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri'];
			$.each(weekdays, function(index, value){
				$('#'+value+'_from').pickatime();
				$('#'+value+'_to').pickatime();
			});
		});
	</script>
@endsection
