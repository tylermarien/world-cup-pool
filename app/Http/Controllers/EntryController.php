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
    public function index()
    {
        $entries = $this->entries->orderBy('total', 'desc')->get();

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
    public function show($id)
    {
        $entry = $this->entries->findOrFail($id);

        return view('entry.show', [
            'entry' => $entry,
        ]);
    }
}
