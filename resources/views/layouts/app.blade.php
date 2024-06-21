<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('World Cup Pool') }}</title>

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body id="page-top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a href="{{ route('entries.index') }}">
                    <img src="{{ asset('img/ball-logo.svg')}} " class="main-logo">
                </a>
                <a class="navbar-brand js-scroll-trigger main-logo-words" href="{{ route('entries.index') }}">
                    {{ $pool->name }}
                </a>
                @if($pools->count() > 1)
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="poolToggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Switch
                    </button>
                    <div class="dropdown-menu" aria-labelledby="poolToggle">
                        @foreach($pools as $pool)
                        <a class="dropdown-item" href="{{ route('pools.toggle', $pool->id) }}">{{ $pool->name }}</a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fa fa-bars"></i>
                </button> -->
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <!-- <ul class="navbar-nav ml-auto">
                        @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="">{{ __('Login') }}</a>
                        </li>
                        @endif
                    </ul> -->
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="container">
                <p>&copy; World Cup Pool 2022 - All Rights Reserved.</p>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
