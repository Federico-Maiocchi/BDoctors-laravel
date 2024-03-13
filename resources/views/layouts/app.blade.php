<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('scss/app.scss') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-light bg-middle-green shadow-sm py-2">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="http://localhost:5174">

                    <img class="logo-small-header d-md-none"
                        src="{{ Vite::asset('resources/img/logo-small-white.png') }}" alt="">
                    <img class="logo-full-header d-none d-md-block"
                        src="{{ Vite::asset('resources/img/logo-white.png') }}" alt="">
                    {{-- config('app.name', 'Laravel') --}}
                </a>
                <div class="dropstart d-lg-none">
                    <button class="nav-dropstart-btn border-2" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <ul class="dropdown-menu">
                        @if (!Auth::guest())
                            @if (isset($doctor))
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.dashboard.index') }}">{{ __('Dashboard') }}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.doctors.edit', $doctor) }}">Modifica Profilo</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.messages.index') }}">I Miei Messaggi</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.reviews.index') }}">Le Mie Recensioni</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.statistics', ['year'=>2024]) }}">Le Mie Statistiche</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.sponsorship.index') }}">
                                        
                                        Abbonamenti
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.doctors.create') }}">Crea Profilo</a>
                                </li>
                            @endif
                        @endif
                        <hr>
                        @guest
                            <li>
                                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto">

                        {{-- @if (!Auth::guest())
                            @if (isset($doctor))

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard.index') }}">{{ __('Dashboard') }}</a>
                        </li> --}}
                        @if (!Auth::guest())
                            @if (isset($doctor))
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('admin.dashboard.index') }}">{{ __('Dashboard') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.doctors.edit', $doctor) }}">Modifica Profilo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.messages.index') }}">Messaggi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.reviews.index') }}">Recensioni</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.statistics', ['year'=>2024]) }}">Statistiche</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.sponsorship.index') }}">Abbonamenti</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.doctors.create') }}">Crea Il Tuo Profilo</a>
                                </li>
                            @endif
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>
