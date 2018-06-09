<?php

namespace App\Http\Controllers\Api;

use App\Team;
use App\Http\Controllers\Controller;

class EntryTeamController extends Controller
{
    /**
     * @var \App\Team
     */
    protected $team;

    /**
     * Create a new controller instance.
     *
     * @param \App\Team $team
     *
     * @return void
     */
    public function __construct(Team $team)
    {
        $this->team = $team;
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
        return $this->team->enteredBy($entry)->paginate();
    }

    /**
     * Display the specified resource.
     *
     * @param int $entry
     * @param int $team
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($entry, $team)
    {
        return $this->team->enteredBy($entry)->findOrFail($team);
    }
}
