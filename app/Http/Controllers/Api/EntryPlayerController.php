<?php

namespace App\Http\Controllers\Api;

use App\Entry;
use App\Player;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EntryPlayerRequest;

class EntryPlayerController extends Controller
{
    /**
     * @var \App\Player
     */
    protected $player;

    /**
     * Create a new controller instance.
     *
     * @param \App\Player $player
     *
     * @return void
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $entry
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index($entry)
    {
        return $this->player->enteredBy($entry)->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\EntryPlayerRequest $request
     * @param \App\Entry                                $entry
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(EntryPlayerRequest $request, Entry $entry)
    {
        $entry->players()->delete();

        $players = $request->input('players');

        foreach ($players as $player) {
            $entry->players()->create(['player_id' => $player]);
        }

        return $entry->fresh('players');
    }

    /**
     * Display the specified resource.
     *
     * @param int $entry
     * @param int $player
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($entry, $player)
    {
        return $this->player->enteredBy($entry)->findOrFail($player);
    }
}
