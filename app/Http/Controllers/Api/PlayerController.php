<?php

namespace App\Http\Controllers\Api;

use App\Player;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PlayerRequest;

class PlayerController extends Controller
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->player->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\PlayerRequest $request
     *
     * @return \App\Player|\Illuminate\Database\Eloquent\Model
     */
    public function store(PlayerRequest $request)
    {
        return $this->player->create($request->validated());
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
        return $this->player->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\PlayerRequest $request
     * @param int                                  $id
     *
     * @return \App\Player|\Illuminate\Database\Eloquent\Model
     */
    public function update(PlayerRequest $request, $id)
    {
        $player = $this->player->findOrFail($id);

        $player->update($request->all());

        return $player;
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
        $this->player->findOrFail($id)->delete();

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
