@extends('layouts.application')

@section('title'){{ getTitle($user->name) }}@endsection


@section('content')
     @if(count($user))
        <div class="page">
            <header class="post-header">
                <img class="logo" src="{{ url($user->picture) }}">
                <div class="name">
                    <h3>{{ $user->name }}</h3>
                    <ul class="info">
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $user->email }}"> {{ $user->email }}</a></li>
                        <li><i class="fa fa-birthday-cake" aria-hidden="true"></i>{{ ArabicDate(\Carbon\Carbon::createFromFormat('Y-m-d', $user->birthday)->format('Y/m/d')) }}</li>
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i>{{ GovArabic($user->governorate) }}</li>
                        @if($user->website)
                        	<li><i class="fa fa-globe" aria-hidden="true"></i><a href="{{ $user->website }}">{{ $user->website }}</a></li>
                        @endif
                        <li>
                        @if($user->facebook)
                        	<a href="{{ $user->facebook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        @endif
                        @if($user->twitter)
                        	<a href="{{ $user->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        @endif
                        @if($user->instagram)
                        	<a href="{{ $user->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        @endif
                        </li>
                    </ul>
                    
                </div>
                <div class="pull-left">
                    	<a style="font-size: 18px;" href="{{ route('application.user.edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
            </header>
        </div>
    @endif
@endsection
