@extends('layouts.admin', ['no_boxes' => true])

@section('content')
    <section class="content">
        <div class="row">
        	@if($count)
                @if(isset($count['organizations']))
                    {!! dashboard_box("bg-red", "building", trans('dashboard.fields.dashboard.organizations'), $count['organizations']) !!}
                @endif
                @if(isset($count['spaces']))
                {!! dashboard_box("bg-green", "circle-o",
                    trans('dashboard.fields.dashboard.spaces'), $count['spaces']) !!}
                @endif
                @if(isset($count['reservations']))
                {!! dashboard_box("bg-yellow", "object-group",
                    trans('dashboard.fields.dashboard.reservations.count'), $count['reservations']) !!}
                @endif
                @if(isset($count['events']))
                {!! dashboard_box("bg-blue", "calendar",
                    trans('dashboard.fields.dashboard.events'), $count['events']) !!}
                @endif
            @else
            	<h3>لوحة التحكم</h3>
            @endif

        </div>
        <div class="row">
            @if (isset($data['reservations'])) 
                <div class="table-box half-width">
                    <h4>{{ trans('dashboard.fields.dashboard.reservations.title') }} <a class="pull-left btn btn-default" href="{{ route('dashboard.reservation.index') }}">{{ trans('dashboard.fields.dashboard.more') }}</a></h4>
                    <table class="table">
                        <thead>
                          <tr>
                            <th>{{ trans('dashboard.fields.dashboard.reservations.name') }}</th>
                            <th>{{ trans('dashboard.fields.dashboard.reservations.status') }}</th>
                            <th>{{ trans('dashboard.fields.dashboard.reservations.created_at') }}</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($data['reservations'] as $reservation)
                                <tr>
                                  <td>{{ $reservation->name }}</td>
                                  <td>{{ $reservation->status }}</td>
                                  <td>{{ $reservation->created_at }}</td>
                                  <td><a class="btn btn-xs bg-navy" href="{{ route('application.reservation.index', ['reservation_url_id' => $reservation->url_id])}}"><i class="fa fa-eye"></i>أظهر</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            @endif
            @if (isset($data['logs'])) 
                <div class="table-box">
                    <h4>{{ trans('dashboard.fields.dashboard.logs.title') }} <a class="pull-left btn btn-default" href="{{ route('dashboard.log.index')}}">{{ trans('dashboard.fields.dashboard.more') }}</a></h4>
                    <table class="table">
                        <thead>
                          <tr>
                            <th>{{ trans('dashboard.fields.dashboard.logs.text') }}</th>
                            <th>{{ trans('dashboard.fields.dashboard.logs.created_at') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($data['logs'] as $log)
                                <tr>
                                  <td>{{ $log->text }}</td>
                                  <td>{{ $log->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            @endif
        </div>
       

    </section>


    {{-- <script src="{{ url('js/raphael.js') }}" type="text/javascript"></script> --}}
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   
@endsection