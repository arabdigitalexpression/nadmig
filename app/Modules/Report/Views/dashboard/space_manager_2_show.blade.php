@extends('layouts.admin')

@section('content')
    <div class="col-xs-12 no-padding">
        <div class="post-title">
            <h2> {{ $object->organization->name }}</h2>
        </div>
    </div>
    <div class="post-description">
	    <h4>نوع الجلسة: {!! getReportType($object->type) !!}</h4> 
	    <h4>اسم\رقم الجلسة: {!! $object->session->name !!}</h4>
	    <h4>التاريخ: {!! $object->date !!}</h4>
	    <h4>عدد الحضور: {!! $object->attendees !!}</h4>
	    <h4>ملاحظات</h4>
	    <p>{!! $object->notes !!}</p>
    </div>
@endsection