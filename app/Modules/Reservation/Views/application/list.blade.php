@extends('layouts.application')

@section('title'){{ getTitle("الحجوزات") }}@endsection

@section('content')
    @if(count($reservations))
        <table class="reservations table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الأسم</th>
                    <th>الحالة</th>
                    <th>تاريخ الحجز</th>
                    <th> </th>
                </tr>
                </thead>
            <tbody>
                @foreach($reservations->sortBy('start_date')->reverse() as $key => $reservation)
                    <tr>
                        <td scope="row">{{ $key+1 }}</th>
                        <td>{{ $reservation->name }}</td>
                        <td>
                            @if($reservation->status == "pending")
                                <i style="color:#898989;" class="fa fa-cog" aria-hidden="true"> تحت النظر</i>
                            @endif
                            @if($reservation->status == "accepted")
                                <i style="color:#39b54a;" class="fa fa-check" aria-hidden="true"> تم الموافقة</i>
                                <script type="text/javascript">
                                    $('.del_{{ $key+1 }}').click(function(e){
                                        if(!confirm("{!! 'فى حالة إلغاء الحجز سوف يتم تطبيق غرامة ' . ArabicCancelFees($reservation->organization->change_fees) !!}")){
                                            return false;
                                        }
                                    });
                                </script>
                            @endif
                        </td>
                        <td>{{ ArabicDate($reservation->sessions[0]['start_date']) . "\t" . ArabicTime($reservation->sessions[0]['start_time']) }}</td>
                        <td>
                        <a class="edit" href="{{ route('application.reservation.index', ['reservation_url_id' => $reservation->url_id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @if(\Carbon\Carbon::now()->subDay()->diffInDays(\Carbon\Carbon::createFromTimeStamp($reservation['start_date']), false) > intval($reservation->organization->min_time_before_usage_to_edit->period) || ( Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization && Auth::user()->manageOrganization->id == $reservation->organization->id ))
                            <a class="edit" href="{{ route('application.reservation.edit', ['reservation_url_id' => $reservation->url_id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            @if(\Carbon\Carbon::now()->subDay()->diffInDays(\Carbon\Carbon::createFromTimeStamp($reservation['start_date']), false) > intval($reservation->organization->min_to_cancel->period))
                                <a class="del del_{{ $key+1 }}" href="{{ route('application.reservation.del', ['reservation_url_id' => $reservation->url_id])}}"><i class="fa fa-times" aria-hidden="true"> إلغاء</i></a>
                            @endif
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
