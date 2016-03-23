@extends('layouts.admin')

@section('content')
    <div class="col-xs-12 no-padding">
        <div class="post-title">
            <h1> {{ $object->name }} <a href="{{ route('dashboard.organization.edit', ['organization' => $object->id ])}}">{{ trans('Organization::dashboard.organization.mine.edit') }}</a> </h1>
        </div>
    </div>
    <p>
        {!! $object->email !!}
    </p>
    <p>
        {!! $object->phone_number !!}
    </p>
    <p>
        {!! $object->geo_location !!}
    </p>
    <h2> {{ trans('Organization::dashboard.fields.organization.description') . ': ' . $object->description  }}</h2>
@endsection