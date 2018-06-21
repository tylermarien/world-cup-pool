<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * @var \App\Player $players
     */
    private $players;

    /**
     * Constructor
     *
     * @param \App\Player $players
     */
    public function __construct(Player $players)
    {
        $this->players = $players;
    }

    /**
     * Display the player
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $player = $this->players->findOrFail($id);

        return view('player.show', [
            'player' => $player,
        ]);
    }
}
