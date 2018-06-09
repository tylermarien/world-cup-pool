<?php

namespace App\Http\Controllers\Api;

use App\Team;
use App\Entry;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EntryTeamRequest;

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
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\EntryTeamRequest $request
     * @param \App\Entry                                $entry
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(EntryTeamRequest $request, Entry $entry)
    {
        $entry->teams()->delete();

        $teams = $request->input('teams');

        foreach ($teams as $team) {
            $entry->teams()->create(['team_id' => $team]);
        }

        return $entry->fresh('teams');
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
