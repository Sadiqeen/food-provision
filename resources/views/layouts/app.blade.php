<!DOCTYPE doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <!-- CSRF Token -->
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <title>
        @yield( 'title', __('Welcome') ) | {{ config('app.name', 'Laravel') }}
    </title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('style')
</head>

<body>
    {{-- Top bar --}}
    <nav class="navbar navbar-expand-sm navbar-light bg-white shadow @auth d-none d-sm-none d-md-block @endauth">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
                <span class="navbar-toggler-icon">
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown" role="button" v-pre="">
                            {{ Auth::user()->name }}
                        </a>
                        <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-right mb-3">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    {{-- manu --}}
    @auth
    <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow" id="navBar">
        <div class="container">
            <a class="navbar-brand d-sm-block d-md-none" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button aria-controls="menuArea" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#menuArea" data-toggle="collapse" type="button">
                <span class="navbar-toggler-icon">
                </span>
            </button>
            <div class="collapse navbar-collapse" id="menuArea">

                <ul class="navbar-nav m-auto">

                    {{-- Admin menu --}}
                    @if (auth()->user()->position == 'admin')
                        @include('layouts.menus.admin')
                    @endif

                    {{-- Customer menu --}}
                    @if (auth()->user()->position == 'customer')
                        @include('layouts.menus.customer')
                    @endif

                    {{-- Customer menu --}}
                    @if (auth()->user()->position == 'employee')
                        @include('layouts.menus.employee')
                    @endif

                    @guest
                    <li class="nav-item d-sm-block d-md-none">
                        <a class="nav-link" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                    </li>
                    @else
                    <li class="nav-item dropdown d-sm-block d-md-none">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown" role="button" v-pre="">
                            {{ Auth::user()->name }}
                            <span class="caret">
                            </span>
                        </a>
                        <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-right mb-3">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @endauth
    <main class="py-4" id="app">
        @yield('content')
    </main>

    <footer class="footer mt-auto bg-white border-top py-3 shadow">
        <div class="container d-flex">
            <small class="text-dark">{{ __('System by') }} <a target="_blank" href="https://web.sadiqeen.com/">Sadiqeen.com</a></small>
            <small class="mx-auto d-none d-sm-none d-md-block">{{ __('Version') }} : 0.1</small>
            <small class="float-right language">
                <a class="ml-2" href="{{ route('language', 'en') }}">English</a>
                <a class="ml-2" href="{{ route('language', 'th') }}">Thai</a>
            </small>
        </div>
    </footer>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('plugins/jquery-3.5.1/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/popper.js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootstrap-4.5.2/js/bootstrap.min.js') }}"></script>
    {{-- sweet alert --}}
    @include('sweetalert::alert')
    @stack('script')
</body>

</html>
