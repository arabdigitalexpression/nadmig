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
            $(".chosen-select").chosen({width: "100%", placeholder_text_multiple: "قم بأختيار الفتية المشتركين بالمدرسة"});
        });
    </script>
@endsection
