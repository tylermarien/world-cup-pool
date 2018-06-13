<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'World Cup Pool') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <img src="{{ asset('img/ball-logo.svg')}} " class="main-logo">
                <a class="navbar-brand js-scroll-trigger main-logo-words" href="#page-top">
                    World Cup <span class="red">Draft</span>
                </a>

                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#download">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#features">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="masthead">
            <div class="container masthead-custom-container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="featured gold">
                            <img src="{{ asset('img/gold-ribbon.svg') }}" class="ribbon">
                            <div class="container">
                                <p>Tayler Marien - <small>100 pts</small></p>
                            </div>
                        </div><!-- End of Jumbotron -->

                        <div class="featured silver">
                            <img src="{{ asset('img/silver-ribbon.svg') }}" class="ribbon">
                            <div class="container">
                                <p>Addan Smith - <small>98 pts</small></p>
                            </div>
                        </div><!-- End of Jumbotron -->

                        <div class="featured bronze">
                            <img src="{{ asset('img/bronze-ribbon.svg') }}" class="ribbon">
                            <div class="container">
                                <p>Junior Freitas - <small>98 pts</small></p>
                            </div>
                        </div><!-- End of Jumbotron -->

                    </div>
                    <div class="col-lg-8">
                        <table class="table table-condensed">
                            <thead>
                            <th>Entry</th>
                            <th class="text-right">Total</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Joe Penna</a></td>
                                <td class="text-right">666</td>
                            </tr>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Anna Gun</a></td>
                                <td class="text-right">555</td>
                            </tr>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Anna Gun</a></td>
                                <td class="text-right">444</td>
                            </tr>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Ronaldo Naz</a></td>
                                <td class="text-right">333</td>
                            </tr>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Joe Penna</a></td>
                                <td class="text-right">666</td>
                            </tr>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Anna Gun</a></td>
                                <td class="text-right">555</td>
                            </tr>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Anna Gun</a></td>
                                <td class="text-right">444</td>
                            </tr>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Ronaldo Naz</a></td>
                                <td class="text-right">333</td>
                            </tr>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Joe Penna</a></td>
                                <td class="text-right">666</td>
                            </tr>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Anna Gun</a></td>
                                <td class="text-right">555</td>
                            </tr>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Anna Gun</a></td>
                                <td class="text-right">444</td>
                            </tr>
                            <tr>
                                <td><a href="#details" class="js-scroll-trigger">Ronaldo Naz</a></td>
                                <td class="text-right">333</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </header>

        <section class="details bg-primary" id="details">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="blue">Junior Freitas <small class="red">9 pts</small></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <h2 class="blue"><small><i class="fas fa-flag"></i></small> Teams</h2>

                        <table class="table table-condensed">

                            <tbody>
                            <tr>
                                <td>Brazil</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Germany</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Guatemala</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Argentina</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Spain</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>France</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Russia</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Japan</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Nigeria</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Marroco</td>
                                <td>20</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="col-md-6">

                        <h2 class="blue"><small><i class="far fa-futbol"></i></small> Players</h2>

                        <table class="table table-condensed">
                            <tbody>
                            <tr>
                                <td>Neymar</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Messi</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>C. Ronaldo</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Caca</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Alexandre Pato</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>David Luis</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Felipe Mello</td>
                                <td>100</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
    </div>
    </section>



    {{--<nav class="navbar navbar-expand-md navbar-light navbar-laravel">--}}
            {{--<div class="container">--}}
                {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                    {{--{{ config('app.name', 'World Cup Pool') }}--}}
                {{--</a>--}}
                {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
                    {{--<span class="navbar-toggler-icon"></span>--}}
                {{--</button>--}}

                {{--<div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
                    {{--<!-- Left Side Of Navbar -->--}}
                    {{--<ul class="navbar-nav mr-auto">--}}

                    {{--</ul>--}}

                    {{--<!-- Right Side Of Navbar -->--}}
                    {{--<ul class="navbar-nav ml-auto">--}}
                        {{--<!-- Authentication Links -->--}}
                        {{--@guest--}}
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                            {{--</li>--}}
                        {{--@else--}}
                            {{--<li class="nav-item dropdown">--}}
                                {{--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                                    {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                                {{--</a>--}}

                                {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
                                    {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                                       {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                        {{--{{ __('Logout') }}--}}
                                    {{--</a>--}}

                                    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                        {{--@csrf--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--@endguest--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</nav>--}}

        {{--<main class="py-4">--}}
            {{--@yield('content')--}}
        {{--</main>--}}
        {{----}}


    <footer>
        <div class="container">
            <p>&copy; World Cup Draft 2018 - <a href="https://coconutsoftware.com" target="_blank">Coconut Software Corporation</a> - All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    </div>
</body>
</html>
