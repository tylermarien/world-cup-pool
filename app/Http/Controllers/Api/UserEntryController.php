<?php

namespace App\Http\Controllers\Api;

use App\Entry;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserEntryRequest;

class UserEntryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\UserEntryRequest $request
     * @param \App\Entry                              $entry
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(UserEntryRequest $request, Entry $entry)
    {
        $entry->teams()->delete();
        $entry->players()->delete();

        $teams = $request->input('teams');
        $players = $request->input('players');

        foreach ($teams as $team) {
            $entry->teams()->create(['team_id' => $team]);
        }

        foreach ($players as $player) {
            $entry->players()->create(['player_id' => $player]);
        }

        return $entry->fresh(['players', 'teams']);
    }
}
