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
                    <th>تاريخ الإنشاء</th>
                    <th> </th>
                </tr>
                </thead>
            <tbody>
                @foreach($reservations as $key => $reservation)
                    <tr>
                        <td scope="row">{{ $key+1 }}</th>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->status }}</td>
                        <td>{{ $reservation->created_at }}</td>
                        <td><a class="edit" href="{{ route('application.reservation.edit', ['reservation_url_id' => $reservation->url_id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a><a class="del" href="{{ route('application.reservation.del', ['reservation_url_id' => $reservation->url_id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
