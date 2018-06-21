@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <section class="details bg-primary" id="details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="blue">{{ $entry->name }} <small class="red">{{ __(':total pts', ['total' => $entry->total]) }}</small></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="blue"><small><i class="fas fa-flag"></i></small> {{ __('Teams') }}</h2>
                    <table class="table table-condensed">
                        <tbody>
                        @foreach($entry->teams as $team)
                        <tr>
                            <td>{{ $team->name }}</td>
                            <td>{{ __(':total pts', ['total' => $team->calculateTotal()]) }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <h2 class="blue"><small><i class="far fa-futbol"></i></small> {{ __('Players') }}</h2>
                    <table class="table table-condensed">
                        <tbody>
                        @foreach($entry->players as $player)
                        <tr>
                            <td>{{ $player->name }}</td>
                            <td>{{ __(':total pts', ['total' => $player->calculateTotal()]) }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@endsection
