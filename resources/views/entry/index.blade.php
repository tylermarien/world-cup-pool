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
                                <p><a href="{{ route('entries.show', ['entry' => $first]) }}">{{ $first->name  }}</a> <small>{{ __('(:played gp)', ['played' => $first->calculateGamesPlayed()]) }} - {{ __(':total pts', ['total' => $first->total]) }}</small></p>
                            </div>
                        </div>

                        <div class="featured silver">
                            <img src="{{ asset('img/silver-ribbon.svg') }}" class="ribbon">
                            <div class="container">
                            <p><a href="{{ route('entries.show', ['entry' => $second]) }}">{{ $second->name  }}</a> <small>{{ __('(:played gp)', ['played' => $second->calculateGamesPlayed()]) }} - {{ __(':total pts', ['total' => $second->total]) }}</small></p>
                            </div>
                        </div>

                        <div class="featured bronze">
                            <img src="{{ asset('img/bronze-ribbon.svg') }}" class="ribbon">
                            <div class="container">
                            <p><a href="{{ route('entries.show', ['entry' => $third]) }}">{{ $third->name }}</a> <small>{{ __('(:played gp)', ['played' => $third->calculateGamesPlayed()]) }} - {{ __(':total pts', ['total' => $third->total]) }}</small></p>
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
                                    <td><a href="{{ route('entries.show', ['entry' => $entry]) }}">{{ $entry->name }}</a> {{ __('(:played gp)', ['played' => $entry->calculateGamesPlayed()]) }}</td>
                                    <td class="text-right">{{ __(':total pts', ['total' => $entry->total]) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p>{{ __('Last updated: :updated', ['updated' => $entries->first()->updated_at->format('F j, Y \@ g:ia')]) }}</p>
                    </div>
                </div>
            </div>
        </header>
@endsection
