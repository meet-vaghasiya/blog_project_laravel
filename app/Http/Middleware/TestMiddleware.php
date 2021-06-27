<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $test, $test2)
    {
        // dd($test, $test2);
        dd($request->input('abcd'));
        if ($request->input('abc')) {
            return redirect()->route('test.redirect');
        }
        return $next($request);
    }
}
