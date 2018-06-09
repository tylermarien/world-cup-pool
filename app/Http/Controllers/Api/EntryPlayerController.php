<?php

namespace App\Http\Controllers\Api;

use App\Player;
use App\Http\Controllers\Controller;

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
