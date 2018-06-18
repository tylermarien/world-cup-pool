@extends('layouts.admin')

@section('title', 'Edit Entry')

@section('content')
    <div class="container">
        <h1>Edit {{ $entry->name }}</h1>
        <form action="{{ route('entries.update', ['entry' => $entry]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $entry->name }}" />
            </div>
            <div class="form-group">
                <label for="teams">Teams</label>
                <select multiple size="10" class="form-control" id="teams" name="teams[]">
                    @foreach($teams as $team)
                    @if($entry->teams->contains($team->id))
                    <option value="{{ $team->id }}" selected>{{ $team->name }}</option>
                    @else
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="players">Players</label>
                <select multiple size="10" class="form-control" id="players" name="players[]">
                    @foreach($players as $player)
                    @if($entry->players->contains($player->id))
                    <option value="{{ $player->id }}" data-team-id="{{ $player->team_id }}" selected>{{ $player->name }}</option>
                    @else
                    <option value="{{ $player->id }}" data-team-id="{{ $player->team_id }}">{{ $player->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    <script type="text/javascript">
        var $teamsEl = $('#teams');
        var $playersEl = $('#players');

        function togglePlayers() {
            var teamIds = $teamsEl.val();
            var allPlayers = $playersEl.children();
            var playersOnSelectedTeams = allPlayers.filter(function (index, child) {
                var teamId = "" + $(child).data('team-id');
                return teamIds.indexOf(teamId) != -1;
            });

            allPlayers.each(function(index, child) {
                var $child = $(child);
                var teamId = "" + $child.data('team-id');

                if (teamIds.indexOf(teamId) != -1) {
                    $child.show();
                } else {
                    $child.hide();
                }
            });
        }

        $teamsEl.change(function (evt) {
            togglePlayers();
        });

        togglePlayers();
    </script>
@endsection
