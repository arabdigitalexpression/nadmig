@extends('layouts.application')

@section('title'){{ getTitle($extra->user->name) }}@endsection


@section('content')
    <div class="page">
     {!! form($form) !!}
     </div>
@endsection
