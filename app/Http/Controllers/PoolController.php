<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoolController extends Controller
{
    public function toggle(Request $request, $pool_id) {
        $request->session()->put('pool_id', $pool_id);
        return redirect()->route('entries.index');
    }
}
