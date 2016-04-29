<?php namespace GSV\Http\Middleware;

use Auth;

class ApiAuthenticated
{
    public function handle($request, \Closure $next)
    {
        if (Auth::guest()) {
            return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}