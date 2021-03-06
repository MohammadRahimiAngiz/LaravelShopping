<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components.min.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" style="background-image: url('/image/bgNature.jpg');background-size: 100vw 100vh;height: 100vh;">
    <nav class="navbar navbar-expand-md  shadow-sm">
        <div class="container ">
            <a class="navbar-brand" href="{{ url('/') }}">
                <strong>
                    {{ config('app.name', 'M.Rahimi.A') }}
                </strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto ">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <figure class="avatar avatar-sm mr-2">
                                    <img src="{{'storage/'.Auth::user()->avatar}}" alt="...">
                                    <i class="avatar-presence online"></i>
                                </figure>
                                <div class="d-sm-none d-lg-inline-block font-weight-bold">{{ Auth::user()->name }}</div>
{{--                                {{ Auth::user()->name }} <span class="caret"></span>--}}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @can('Super-user')
                                    <a class="dropdown-item" href="{{route('admin.dashboard')}}"><i class="fas fa-ellipsis-h pr-2 " style="color: #e3342f;"></i>Admin Panel</a>
                                @endcan
                                <a class="dropdown-item" href="{{route('profile')}}"><i class="fas fa-ellipsis-h pr-2 "
                                                                                        style="color: #e3342f;"></i>Profile</a>
                                <a class="dropdown-item" href="{{route('profile.orders')}}"><i
                                        class="fas fa-ellipsis-h pr-2 " style="color: #e3342f;"></i>My Orders</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-ellipsis-h pr-2 " style="color: #e3342f;"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@yield('script')

@include('sweet::alert')
</body>
</html>
