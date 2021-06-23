<div class="featured {{ $colour }}">
    <img src="{{ asset('img/' . $colour . '-ribbon.svg') }}" class="ribbon">
    <div class="container">
        <p>
            <a href="{{ route('entries.show', ['id' => $entry]) }}">{{ $entry->name  }}</a> - <small>{{ __(':total pts', ['total' => $entry->total]) }}</small>
            <br><small>{{ __('(:played gp, :remaining teams)', ['played' => $entry->calculateGamesPlayed(), 'remaining' => $entry->calculateTeamsRemaining()]) }}</small>
        </p>
    </div>
</div>