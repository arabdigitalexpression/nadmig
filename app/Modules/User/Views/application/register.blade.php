@extends('layouts.auth')

@section('title')
    {{ trans('user.register.title') }} | {{ trans('dashboard.title') }}
@stop

@section('content')

    <div class="login-box" id="login-box">
        <div class="header">
            <i class="fa fa-user-plus"></i> {{ trans('User::application.register.title') }}
        </div>
        <div class="body bg-gray-50">
            {!! form($form) !!}
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#birthday').pickadate({
                format: 'yyyy-mm-dd',
                min: [1940,1,1],
                max: new Date(),
                selectYears: 75,
                selectMonths: true
            });
        });
    </script>
@endsection
