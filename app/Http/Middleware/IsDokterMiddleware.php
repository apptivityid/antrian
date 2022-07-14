<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDokterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->level == "pasien") {
            return response()->json(["error" => "you don't have access!"], 403);
        }

        return $next($request);
    }
}
