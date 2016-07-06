@extends('layouts.application')

@section('title'){{ getTitle('التسجيل فى المدارس الصيفية') }}@endsection


@section('content')
    <div class="page">
        {!! form($form) !!}
        <script type="text/javascript">
            $(function () {
                $('#birthday').pickadate({
                    format: 'yyyy-mm-dd',
                    min: [1940,1,1],
                    max: new Date(),
                    selectYears: 75,
                    selectMonths: true
                });
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
    </div>
@endsection
