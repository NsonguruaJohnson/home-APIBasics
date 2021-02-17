<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminChecker
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
        if (auth()-user()->role->name !== 'admin'){
            return [
                'status' => 409,
                'message' => 'Unauthorised action'
            ];
        }

        return $next($request);
    }
}
