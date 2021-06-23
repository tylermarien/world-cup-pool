<h5 class="blue">Teams</h5>
<table class="table table-condensed">
    <tbody>
    @foreach($entry->teams->sortBy('name') as $team)
    @if($comparison->hasTeam($team))
    <tr class="text-muted">
    @else
    <tr class="bg-light text-success">
    @endif
        <td>{{ $team->name }}</td>
        <td>{{ __(':total pts', ['total' => $team->calculateTotal()]) }}</td>
    </tr>
    @endforeach
    </tbody>
</table>