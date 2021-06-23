@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<header class="masthead">
            <div class="container masthead-custom-container">
                <div class="row">
                    <div class="col-lg-4">
                        @include('entry.standings.ribbon', ['colour' => 'gold', 'entry' => $first])
                        @include('entry.standings.ribbon', ['colour' => 'silver', 'entry' => $second])
                        @include('entry.standings.ribbon', ['colour' => 'bronze', 'entry' => $third])
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
                                    <td><a href="{{ route('entries.show', ['id' => $entry]) }}">{{ $entry->name }}</a> {{ __('(:played gp, :remaining teams)', ['played' => $entry->calculateGamesPlayed(), 'remaining' => $entry->calculateTeamsRemaining()]) }}</td>
                                    <td class="text-right">{{ __(':total pts', ['total' => $entry->total]) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p>{{ __('Last updated: :updated', ['updated' => $entries->first()->updated_at->tz('America/Regina')->format('F j, Y \@ g:ia T')]) }}</p>
                    </div>
                </div>
            </div>
        </header>
@endsection
