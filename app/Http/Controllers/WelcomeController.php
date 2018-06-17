<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Entry::orderBy('total')->get();

        return view('welcome', [
            'first' => $entries->first(),
            'second' => $entries->get(2),
            'third' => $entries->get(3),
            'entries' => $entries->slice(4),
        ]);
    }
}
