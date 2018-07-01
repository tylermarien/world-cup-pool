@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <section class="details bg-primary" id="details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="blue">{{ $team->name }} <small class="red">{{ __(':total pts', ['total' => $team->calculateTotal()]) }}</small></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <td>{{ __('Games Played') }}</td>
                            <td>{{ $team->games_played }}</td>
                            <td>{{ __(':points pts', ['points' => $team->calculateGamesPlayedPoints()]) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Wins') }}</td>
                            <td>{{ $team->wins }}</td>
                            <td>{{ __(':points pts', ['points' => $team->calculateWinPoints()]) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Ties') }}</td>
                            <td>{{ $team->ties }}</td>
                            <td>{{ __(':points pts', ['points' => $team->calculateTiePoints()]) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Goal Differential') }}</td>
                            <td>{{ $team->goal_differential }}</td>
                            <td>{{ __(':points pts', ['points' => $team->calculateGoalDifferentialPoints()]) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Shootout Wins') }}</td>
                            <td>{{ $team->shootout_wins }}</td>
                            <td>{{ __(':points pts', ['points' => $team->calculateShootoutWinPoints()]) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Shutouts') }}</td>
                            <td>{{ $team->shutouts }}</td>
                            <td>{{ __(':points pts', ['points' => $team->calculateShutoutPoints()]) }}</td>
                        </tr>
                        @if (!is_null($team->pool_placing))
                        <tr>
                            <td>{{ __('Pool Placing') }}</td>
                            <td>{{ $team->pool_placing }}</td>
                            <td>{{ __(':points pts', ['points' => $team->calculatePoolPlacingPoints()]) }}</td>
                        </tr>
                        @endif
                        @if (!is_null($team->final_placing))
                        <tr>
                            <td>{{ __('Final Placing') }}</td>
                            <td>{{ $team->final_placing }}</td>
                            <td>{{ __(':points pts', ['points' => $team->calculateFinalPlacingPoints()]) }}</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@endsection
