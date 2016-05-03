<nav class="navbar navbar-default navbar-custom">
    <div class="container">
        <div class="inside">
            <a class="navbar-brand" href="{{  route('root') }}">{{ trans('application.title') }}</a>
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
                <li><a href="">{{ trans('application.menu.events') }}</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-left user">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">تسجيل الدخول</a></li>
                    <span class="break">|</span>
                    <li><a href="{{ url('/auth/register') }}">تسجيل مستخدم جديد</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img class="pp" src="{{ url(Auth::user()->picture)}}"><span class="name">{{ Auth::user()->name }}</span> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @role('admin')
                                <li><a href="{{ url('/dashboard') }}">{{ trans('application.menu.dashboard') }}</a>
                            @endrole
                            <li><a href="{{ url('/auth/logout') }}">{{ trans('application.menu.logout') }}</a></li>
                        </ul>
                    </li>
                @endif
              </ul>
            </div><!-- /.navbar-collapse -->
        </div>
        @if (Session::has('flash_notification.message'))
            <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>

                {{ Session::get('flash_notification.message') }}
            </div>
        @endif
</nav>
