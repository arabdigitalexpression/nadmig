@extends('layouts.admin')

@section('content')
    <div class="col-xs-12 no-padding">
        <div class="post-title">
            <h2> {{ $object->name }} <a style="float: left;" href="{{ route('dashboard.organization.edit', ['organization' => $object->id ])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a> </h2>
            
            <ul class="info">
                <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $object->address }}</li>
                <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $object->phone_number }}</li>
                <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $object->email }}"> {{ $object->email }}</a></li>
                @if($object->links)
                    @foreach($object->links as $link)
                            <li><i class="fa fa-<?php if($link['type'] == 'website') {echo "globe";}else{echo $link['type'];} ?>" aria-hidden="true"></i> <a href="{{ $link['link'] }}">{{ $link['link'] }}</a></li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="post-excerpt">
        <h3>{!! trans('Organization::dashboard.fields.organization.excerpt') !!}:</h3>
        {!! $object->excerpt !!}
    </div>
    <div class="post-description">
        <h3>{!! trans('Organization::dashboard.fields.organization.description') !!}:</h3>
        {!! $object->description !!}
    </div>
@endsection