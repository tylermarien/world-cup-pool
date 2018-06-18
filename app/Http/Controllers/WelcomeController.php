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
        $entries = Entry::orderBy('total', 'desc')->get();

        return view('welcome', [
            'first' => $entries->get(0),
            'second' => $entries->get(1),
            'third' => $entries->get(2),
            'entries' => $entries->slice(3),
        ]);
    }
}
