<?php

namespace App\Http\Middleware;

use Closure;
use App\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LoadPool
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $pool = Pool::find($request->session()->get('pool_id', 1));

        View::share('pools', Pool::all());
        View::share('pool', $pool);

        return $next($request);
    }
}
