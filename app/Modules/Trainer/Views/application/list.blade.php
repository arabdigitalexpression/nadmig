@extends('layouts.application')

@section('title'){{ getTitle('المدربين') }}@endsection

@section('content')
    @if(count($trainers))
        <ul class="spaces-list">
        @foreach($trainers as $trainer)
            <li class="panel panel-default panel-orange">
                <a href="{{ route('trainer.page', ['trainer_slug' => $trainer->slug]) }}">
                <img src="{{ url($trainer->user->picture) }}" class="space-icon img-responsive">
                </a>   
                    
                    <ul class="space-info">
                        <li>{{ $trainer->user->name }}</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $trainer->user->email }}"> {{ $trainer->user->email }}</a></li>
                        {{-- <li><i class="fa fa-birthday-cake" aria-hidden="true"></i>{{ ArabicDate(\Carbon\Carbon::createFromFormat('Y-m-d', $trainer->user->birthday)->format('Y/m/d')) }}</li> --}}
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i>{{ GovArabic($trainer->user->governorate) }}</li>
                        @if($trainer->user->website)
                            <li><i class="fa fa-globe" aria-hidden="true"></i><a href="{{ $trainer->user->website }}">{{ $trainer->user->website }}</a></li>
                        @endif
                        <li>
                        @if($trainer->user->facebook)
                            <a href="{{ $trainer->user->facebook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        @endif
                        @if($trainer->user->twitter)
                            <a href="{{ $trainer->user->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        @endif
                        @if($trainer->user->instagram)
                            <a href="{{ $trainer->user->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        @endif
                        </li>
                    </ul>
                
            </li>
        @endforeach
        </ul>
    @endif
@endsection
