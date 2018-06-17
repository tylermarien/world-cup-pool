@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<header class="masthead">
            <div class="container masthead-custom-container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="featured gold">
                            <img src="{{ asset('img/gold-ribbon.svg') }}" class="ribbon">
                            <div class="container">
                                <p>{{ $first->name  }} - <small>{{ __(':total pts', ['total' => $first->total]) }}</small></p>
                            </div>
                        </div>

                        <div class="featured silver">
                            <img src="{{ asset('img/silver-ribbon.svg') }}" class="ribbon">
                            <div class="container">
                            <p>{{ $second->name  }} - <small>{{ __(':total pts', ['total' => $second->total]) }}</small></p>
                            </div>
                        </div>

                        <div class="featured bronze">
                            <img src="{{ asset('img/bronze-ribbon.svg') }}" class="ribbon">
                            <div class="container">
                            <p>{{ $third->name  }} - <small>{{ __(':total pts', ['total' => $third->total]) }}</small></p>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8">
                        <table class="table table-condensed">
                            <thead>
                            <th>Entry</th>
                            <th class="text-right">Total</th>
                            </thead>
                            <tbody>
                                @foreach($entries as $entry)
                                <tr>
                                    <td><a href="#details" class="js-scroll-trigger">{{ $entry->name }}</a></td>
                                    <td class="text-right">{{ __(':total pts', ['total' => $entry->total]) }}</td>
                                </tr>
                                @endforeach
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
                    <h1 class="blue">{{ __('Name') }} <small class="red">{{ __('Points') }} pts</small></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="blue"><small><i class="fas fa-flag"></i></small> {{ __('Teams') }}</h2>
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <td>{{ __('Team') }}</td>
                            <td>{{ __('Points') }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <h2 class="blue"><small><i class="far fa-futbol"></i></small> {{ __('Players') }}</h2>
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <td>{{ __('Player') }}</td>
                            <td>{{ __('Points') }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@endsection
