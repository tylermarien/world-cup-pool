<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * @var \App\Team $teams
     */
    private $teams;

    /**
     * Constructor
     *
     * @param \App\Team $teams
     */
    public function __construct(Team $teams)
    {
        $this->teams = $teams;
    }

    /**
     * Display the team
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = $this->teams->findOrFail($id);

        return view('team.show', [
            'team' => $team,
        ]);
    }
}
