@extends('layouts.admin')

@section('content')
    {!! form($form) !!}
    @include('partials.admin.tinymce')
    <script type="text/javascript">
		$(function(){
			$('#period_type').change( function() {
				if ($('#period_type option:selected').val() == "free" || $('#period_type option:selected').val() == "any") {
					$('#period_period').attr('type', 'hidden');
				}else{
					$('#period_period').attr('type', 'number');
				}
			});
		});
	</script>
@endsection
