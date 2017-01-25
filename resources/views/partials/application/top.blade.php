<nav class="navbar navbar-default navbar-custom">
    <div class="container">
        <div class="inside">
            <a class="navbar-brand" href="{{  route('root') }}">{{ trans('application.title') }} <span style="font-size: 10px;">تجريبي</span></a>
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right menu">
                <li class="{{ Route::is('root') ? 'active' : '' }}"><a href="{{  route('root') }}">{{ trans('application.menu.home') }}</a></li>
                <li class="{{ Route::is('spaces') ? 'active' : '' }}"><a href="{{  route('spaces') }}">{{ trans('application.menu.spaces') }}</a></li>
                <li class="{{ Route::is('events') ? 'active' : '' }}"><a href="{{  route('events') }}">{{ trans('application.menu.events') }}</a></li>
                <li class="{{ Route::is('programs') ? 'active' : '' }}"><a href="{{  route('programs') }}">{{ trans('application.menu.programs') }}</a></li>
                <li class="{{ Route::is('page') ? 'active' : '' }}"><a href="{{  route('page', ['page_slug' => 'ندمج']) }}">{{ trans('application.menu.about_us') }}</a></li>
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="name">{{ trans('School::application.title') }}</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('application.attendees.create') }}">{{ trans('Attendees::application.attendees.create') }}</a></li>
                        <li><a href="{{ route('schools') }}">{{ trans('School::application.title') }}</a></li>
                        <li><a href="{{ route('trainers') }}">{{ trans('Trainer::application.title') }}</a></li>
                    </ul>
                </li> -->
              </ul>
              
                @if (Auth::guest())
                <ul class="nav navbar-nav navbar-left guest">
                    <li><a href="{{ url('/auth/login') }}">{{ trans('auth.login.title') }}</a></li>
                    <span class="break">|</span>
                    <li><a href="{{ url('/user/register') }}">{{ trans('auth.signup.title') }}</a></li>
                </ul>
                @else
                <ul class="nav navbar-nav navbar-left user">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img class="pp" src="{{ url(Auth::user()->picture)}}"><span class="name">{{ Auth::user()->name }}</span> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @role(['admin','organization_manager', 'space_manager'])
                                <li><a href="{{ url('/dashboard') }}">{{ trans('application.menu.dashboard') }}</a>
                            @endrole
                            @if (Auth::user()->trainer)
                                <li><a href="{{ url('/trainer') }}">{{ trans('application.menu.trainer') }}</a>
                            @endif
                            <li><a href="{{ route('application.user.index') }}">{{ trans('application.menu.user') }}</a></li>
                            <li><a href="{{ route('reservation') }}">{{ trans('application.menu.reservation') }}</a></li>
                            <li><a href="{{ url('/auth/logout') }}">{{ trans('application.menu.logout') }}</a></li>
                        </ul>
                    </li>
                </ul>
                @endif
              
            </div><!-- /.navbar-collapse -->
        </div>
        @if (Session::has('flash_notification.message'))
            <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>

                {{ Session::get('flash_notification.message') }}
            </div>
        @endif
</nav>
