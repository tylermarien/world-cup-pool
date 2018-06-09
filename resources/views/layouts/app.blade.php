<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" id="csrf_token" content="{{ csrf_token() }}">

    <title> @yield('title') | {{ config('app.name', 'World Cup Draft') }}</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    World Cup Draft
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
