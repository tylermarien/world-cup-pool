<h5 class="blue">Players</h5>
<table class="table table-condensed">
    <tbody>
    @foreach($entry->players->sortBy('name') as $player)
    @if($comparison->hasPlayer($player))
    <tr class="text-muted">
    @else
    <tr class="bg-light text-success">
    @endif
        <td>{{ $player->name }}</td>
        <td>{{ __(':total pts', ['total' => $player->calculateTotal()]) }}</td>
    </tr>
    @endforeach
    </tbody>
</table>