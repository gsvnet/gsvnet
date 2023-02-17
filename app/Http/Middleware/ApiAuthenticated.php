<?php

namespace App\Http\Middleware;

use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
