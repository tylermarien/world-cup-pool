@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <section class="details bg-primary" id="details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="blue">{{ $player->name }} <small class="red">{{ __(':total pts', ['total' => $player->calculateTotal()]) }}</small></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <td>{{ __('Goals') }}</td>
                            <td>{{ $player->goals }}</td>
                            <td>{{ __(':points pts', ['points' => $player->calculateGoalPoints()]) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@endsection
