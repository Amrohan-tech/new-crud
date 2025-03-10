<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $test = $request->input('test'); 

        if (!$test) {
            return response()->json(['error' => 'Token not provided'], 401);
        }
        
        return $next($request);
    }
}
