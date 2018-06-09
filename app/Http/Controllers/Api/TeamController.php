<?php

namespace App\Http\Controllers\Api;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class TeamController extends Controller
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->team->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Team|\Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request)
    {
        return $this->team->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        return $this->team->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \App\Team|\Illuminate\Database\Eloquent\Model
     */
    public function update(Request $request, $id)
    {
        $team = $this->team->findOrFail($id);

        $team->update($request->all());

        return $team;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->team->findOrFail($id)->delete();

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
