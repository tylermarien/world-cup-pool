<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * @var \App\Entry $entries
     */
    private $entries;

    /**
     * Constructor
     *
     * @param \App\Entry $entries
     */
    public function __construct(Entry $entries)
    {
        $this->entries = $entries;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $entries = $this->entries->where('pool_id', $request->session()->get('pool_id', 1))->orderBy('total', 'desc')->get();

        return view('entry.index', [
            'first' => $entries->get(0),
            'second' => $entries->get(1),
            'third' => $entries->get(2),
            'entries' => $entries->slice(3),
        ]);
    }

    /**
     * Display the entry
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $entries = $this->entries->where('pool_id', $request->session()->get('pool_id', 1))->get();
        $entry = $this->entries->findOrFail($id);

        return view('entry.show', [
            'entries' => $entries,
            'entry' => $entry,
        ]);
    }

    public function compare(Request $request, $id1, $id2)
    {
        $entries = $this->entries->where('pool_id', $request->session()->get('pool_id', 1))->get();
        $left = $this->entries->findOrFail($id1);
        $right = $this->entries->findOrFail($id2);

        return view('entry.compare', [
            'entries' => $entries,
            'left' => $left,
            'right' => $right,
        ]);
    }
}
