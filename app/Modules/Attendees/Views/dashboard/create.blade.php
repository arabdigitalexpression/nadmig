@extends('layouts.admin')

@section('content')
    {!! form($form) !!}
    <script type="text/javascript">
        $(function () {
        	$('#hear_about_us').on('change', function() {
                var id = $(this).attr('name').replace("[type]", ""); 
                if ($('#' + $(this).attr('id') + ' option:selected').val() == "other") {
                    $('#'+id+'_other').attr('type', 'text');
                }else{
                    $('#'+id+'_other').attr('type', 'hidden');
                }
            });
        });
    </script>
@endsection
