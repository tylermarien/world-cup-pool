<?php

namespace App\Http\Controllers\Api;

use App\Pool;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PoolRequest;

class PoolController extends Controller
{
    /**
     * @var \App\Pool
     */
    protected $pool;

    /**
     * Create a new controller instance.
     *
     * @param \App\Pool $pool
     *
     * @return void
     */
    public function __construct(Pool $pool)
    {
        $this->pool = $pool;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->pool->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\PoolRequest $request
     *
     * @return \App\Pool|\Illuminate\Database\Eloquent\Model
     */
    public function store(PoolRequest $request)
    {
        return $this->pool->create($request->all());
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
        return $this->pool->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\PoolRequest $request
     * @param int                                $id
     *
     * @return \App\Pool|\Illuminate\Database\Eloquent\Model
     */
    public function update(PoolRequest $request, $id)
    {
        $pool = $this->pool->findOrFail($id);

        $pool->update($request->all());

        return $pool;
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
        $this->pool->findOrFail($id)->delete();

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
