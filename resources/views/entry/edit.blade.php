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
                    @foreach($teams as $team) {
                    <optgroup label="{{ $team->name }}">
                        @foreach($team->players()->orderBy('name')->get() as $player)
                        @if($entry->players->contains($player->id))
                        <option value="{{ $player->id }}" selected>{{ $player->name }}</option>
                        @else
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endif
                        @endforeach
                    @endforeach
                    </optgroup>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
