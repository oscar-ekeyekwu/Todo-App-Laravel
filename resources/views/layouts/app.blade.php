<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- JQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"  style="color: white;">
                    <i class="fa fa-check"></i>
                    {{ config('app.name', 'Todo List App') }}
                </a>
                <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <strong>
                                    <a class="nav-link" href="{{ route('login') }}" style="color: white;">
                                        {{ __('Login') }}
                                    </a>
                                </strong>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <strong>
                                        <a class="nav-link" href="{{ route('register') }}" style="color: white;">{{ __('Register') }}</a>
                                    </strong>
                                </li>
                            @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                                        {{-- @if(Auth::guard('admin')->check())
                                            Hello {{Auth::guard('admin')->user()->name}}
                                        @elseif(Auth::guard()->check())
                                            {{Auth::user()->name ?? 'Logout'}}
                                        @endif --}}
                                      {{ Auth::user()->name ?? 'Logout'}}
                                      <span class="caret"></span>
                                    </a>


                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/home"><i class="fa fa-dashboard"></i>
                                            {{ __('Dashboard') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                        <i class="fa fa-sign-out"></i>
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>

                                </li>
                        @endguest
                    </ul>
                </div>
            </div>
            @yield('back-button')
        </nav>

        <main class="py-4 row">
            @yield('content')
        </main>
    </div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/custom.js') }}" defer></script>

<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(".select2").select2({
        allowClear: true
    });
</script>

</body>
</html>
