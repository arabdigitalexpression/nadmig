<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="utf-8">
    </head>
    <body style="direction: rtl;">
        <div>
		<h4>تم إنشاء حجز : <i>{{ $reservation->name }}</i></h4>
		<br />
            <p>{{ $reservation->description }}</p>
        <br />
        <br />
        <b>المسؤول عن الحجز: </b> {{ $reservation->facilitator_name }}
        <br />
        <b>عنوان برديه الإلكتروني:</b> {{ $reservation->facilitator_email }}
        <br />
        <b>رقم هاتفه:</b> {{ $reservation->facilitator_phone }}
        <br />
		للإطلاع على الحجز اضغط <a href="{{ URL::to('reservation/' . $reservation->url_id) }}"> هنا </a>.<br/>
        </div>
        <hr>
        <i style="color: #9B9B9B; text-align: center;">منصة ندمج ٢٠١٧ <br> لمراسلتنا <a href="mailto:nadmig@arabdigitalexpression.org">nadmig@arabdigitalexpression.org</a></i>
    </body>
</html>
