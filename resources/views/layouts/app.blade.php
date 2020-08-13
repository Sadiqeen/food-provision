<!DOCTYPE doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <!-- CSRF Token -->
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <title>
        @yield( 'title', __('Welcome') ) | Food Provision Systems
    </title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
        {{-- Top bar --}}
        <nav class="navbar navbar-expand-sm navbar-light bg-white shadow @auth d-none d-sm-none d-md-block @endauth">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
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
                            <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle"
                                data-toggle="dropdown" href="#" id="navbarDropdown" role="button" v-pre="">
                                {{ Auth::user()->name }}
                                <span class="caret">
                                </span>
                            </a>
                            <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-right mb-3">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form action="{{ route('logout') }}" id="logout-form" method="POST"
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
        {{-- manu --}}
        @auth
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow" id="navBar">
            <div class="container">
                <a class="navbar-brand d-sm-block d-md-none" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button aria-controls="menuArea" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler" data-target="#menuArea" data-toggle="collapse" type="button">
                    <span class="navbar-toggler-icon">
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="menuArea">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                {{ __('Dashboard') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                {{ __('Orders') }}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle"
                                data-toggle="dropdown" href="#" id="productDropdown" role="button">
                                {{ __('Product') }}
                            </a>
                            <div aria-labelledby="productDropdown" class="dropdown-menu mb-3">
                                <a class="dropdown-item" href="#">
                                    Action
                                </a>
                                <a class="dropdown-item" href="#">
                                    Category
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                {{ __('Customer') }}
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('admin.supplier.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.supplier.index') }}">
                                {{ __('Supplier') }}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle"
                                data-toggle="dropdown" href="#" id="settingDropdown" role="button">
                                {{ __('Setting') }}
                            </a>
                            <div aria-labelledby="settingDropdown" class="dropdown-menu mb-3">
                                <a class="dropdown-item" href="#">
                                    Action
                                </a>
                                <a class="dropdown-item" href="#">
                                    Another action
                                </a>
                                <div class="dropdown-divider">
                                </div>
                                <a class="dropdown-item" href="#">
                                    Something else here
                                </a>
                            </div>
                        </li>

                        @guest
                        <li class="nav-item d-sm-block d-md-none">
                            <a class="nav-link" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </li>
                        @else
                        <li class="nav-item dropdown d-sm-block d-md-none">
                            <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle"
                                data-toggle="dropdown" href="#" id="navbarDropdown" role="button" v-pre="">
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
    <script defer="" src="{{ asset('js/app.js') }}"></script>
    @stack('script')

</body>

</html>
