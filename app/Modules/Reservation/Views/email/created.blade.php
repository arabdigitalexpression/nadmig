<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="utf-8">
    </head>
    <body style="direction: rtl;">
        <h2>تم إنشاء حجز</h2>

        <div>
		تم إنشاء حجز بعنوان {{ $reservation->name }}
		<br />
            {{ $reservation->description }}
        <br />
        المسؤول عن الحجز:  {{ $reservation->facilitator_name }}
        <br />
        عنوان برديه الإلكتروني: {{ $reservation->facilitator_email }}
        <br />
        رقم هاتفه: {{ $reservation->facilitator_phone }}
        <br />
		للإطلاع على الحجز اضغط <a href="{{ URL::to('reservation/' . $reservation->url_id) }}"> هنا </a>.<br/>
        </div>

    </body>
</html>
