<?php

namespace App\Http\Controllers\Api;

use App\Entry;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EntryRequest;

class EntryController extends Controller
{
    /**
     * @var \App\Entry
     */
    protected $entry;

    /**
     * Create a new controller instance.
     *
     * @param \App\Entry $entry
     *
     * @return void
     */
    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->entry->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\EntryRequest $request
     *
     * @return \App\Entry|\Illuminate\Database\Eloquent\Model
     */
    public function store(EntryRequest $request)
    {
        return $this->entry->create($request->all());
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
        return $this->entry->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\EntryRequest $request
     * @param int                                 $id
     *
     * @return \App\Entry|\Illuminate\Database\Eloquent\Model
     */
    public function update(EntryRequest $request, $id)
    {
        $entry = $this->entry->findOrFail($id);

        $entry->update($request->all());

        return $entry;
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
        $this->entry->findOrFail($id)->delete();

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
