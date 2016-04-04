@extends('layouts.application')


@section('content')
    {!! form($form) !!}
    @include('partials.admin.tinymce')
    <script type="text/javascript">
        $(function () {
            var $date = $('#start_date').pickadate({
            	firstDay: 0,
            	format: 'dd/mm/yyyy',
            	min: new Date(2016,3,1),
        	 	disable: [
        	 		// get not working days
        	 		@if ($extra->working_week_days)
        	 			{!! implode(",",getNotWorkingWeekdays($extra->working_week_days)); !!}
        	 		@endif
				]
            });
            var $deadline = $('#apply_deadline').pickadate({
            	firstDay: 0,
            	format: 'dd/mm/yyyy',
            	min: new Date(2016,3,1),
        	 	disable: [
        	 		// get not working days
        	 		@if ($extra->working_week_days)
        	 			{!! implode(",",getNotWorkingWeekdays($extra->working_week_days)); !!}
        	 		@endif
				]
            });
            var pickerDate = $date.pickadate('picker')
            var pickerDeadline = $deadline.pickadate('picker');
            pickerDeadline.on({
			  open: function(thingSet) {
			  	console.log(pickerDate.get());
			    pickerDeadline.set('max', pickerDate.get());
			  }
			});
            $('#start_time').pickatime();
            $('select').on('change', function() {
				var id = $(this).attr('name').replace("[type]", ""); 
				if ($('#' + $(this).attr('id') + ' option:selected').val() == "null") {
					$('#'+id+'_period').attr('type', 'hidden');
				}else{
					$('#'+id+'_period').attr('type', 'number');
				}
			});
            $('select').each(function() {
				var id = $(this).attr('name').replace("[type]", ""); 
				if ($('#' + $(this).attr('id') + ' option:selected').val() == "null") {
					$('#'+id+'_period').attr('type', 'hidden');
				}else{
					$('#'+id+'_period').attr('type', 'number');
				}
			});

            
        });
    </script>
@endsection
