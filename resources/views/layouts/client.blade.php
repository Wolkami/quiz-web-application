<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Приложение для проведения тестирования') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="py-2 bg-white shadow-sm">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-8">
                        <h2 class="mb-0">{{ __('Приложение для проведения тестирования') }}</h2>
                    </div>
                    <div class="col-4">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            @auth
                                <a class="btn btn-outline-primary mr-2" href="{{ route('admin.results.index') }}">
                                    {{ auth()->user()->name }}
                                </a>
                                <a class="btn btn-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
                                    {{ config('constants.auth.logout_button_text') }}
                                </a>
                            @endauth
                            <form class="d-none" action="{{ route('logout') }}" id="logout-form" method="post">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
