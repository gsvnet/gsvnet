<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Auth;

class ApiAuthenticated
{
    public function handle(Request $request, \Closure $next): Response
    {
        if (Auth::guest()) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
