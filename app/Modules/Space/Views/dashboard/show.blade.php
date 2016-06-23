@extends('layouts.admin')

@section('content')
    <h3>{{ $object->name }} <a style="float: left;" href="{{ route('dashboard.space.edit', ['space' => $object->id ])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></h3>
    <h4><strong>الحالة :</strong>
    @if($object->status == 'working')
        عامل
    @elseif($object->status == 'stoped')
        عاطل
    @elseif($object->status == 'closed')
        مغلق
    @endif
    </h4>
    <h4><strong>{!! trans('Space::dashboard.fields.space.space_type') !!}:</strong>
    		{!! trans('Space::dashboard.fields.space.' . $object->space_type) !!}
    </h4>
     <ul class="info">
        <li><i class="fa fa-building" aria-hidden="true"></i><a href="{{ route('organization.page', ['organization_slug' => $object->organization->slug ])}}">{{ $object->organization->name }}</a></li>
        <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $object->geo_location }}</li>
        <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $object->phone_number }}</li>
        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $object->email }}"> {{ $object->email }}</a></li>
        @foreach($object->links as $link)
       		<li><i class="fa fa-<?php if($link->type == 'website') {echo "globe";}else{echo $link->type;} ?>" aria-hidden="true"></i> <a href="{{ $link->link }}">{{ $link->link }}</a></li>
        @endforeach
    </ul>
    <div class="post-excerpt">
        <h3>{!! trans('Space::dashboard.fields.space.excerpt') !!}:</h3>
        {!! $object->excerpt !!}
    </div>
    <div class="post-description">
        <h3>{!! trans('Space::dashboard.fields.space.description') !!}:</h3>
        {!! $object->description !!}
    </div>
    <div class="extra_info">
    	<h4><strong>{!! trans('Space::dashboard.fields.space.in_return_key') !!}:</strong>
    		{!! trans('Space::dashboard.fields.space.' . $object->in_return_key) . " " . $object->in_return !!}
    	</h4>
    	<h4><strong>{!! trans('Space::dashboard.fields.space.working_week_days') !!}:</strong>
    		<br>
    		@foreach($object->working_week_days as $day)
    			{{getWeekdays($day)}} : من {{ $object->working_hours_days->{$day}->from }} إلى 
    			{{ $object->working_hours_days->tue->to }}
    			<br>
    		@endforeach
    	</h4>
    	<h4><strong>{!! trans('Space::dashboard.fields.space.space_equipment') !!}:</strong>
    		<br>
    		@foreach($object->space_equipment as $equipment)
    			{{ getSpaceEquipment($equipment) }}
    			<br>
    		@endforeach
    	</h4>
    	<h4><strong>{!! trans('Space::dashboard.fields.space.agreement_text') !!}:</strong>
    		<br>
    		{!! $object->agreement_text !!}
    	</h4>
    	<h4><strong>{!! trans('Space::dashboard.fields.space.capacity') !!}:</strong>
    		{!! $object->capacity !!}
    	</h4>
    	<h4><strong>{!! trans('Space::dashboard.fields.space.smoking') !!}:</strong>
    		{!! $object->smoking !!}
    	</h4>
    </div>
@endsection
