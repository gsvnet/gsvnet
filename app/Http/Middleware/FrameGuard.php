<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FrameGuard
{
    /**
     * Handle the given request and get the response.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
            Temporary CSP

            Todo after the new front page has been implemented:
            - Implement proper, much more extensive CSP from https://github.com/spatie/laravel-csp
        */

        $response = $next($request);

        $response->headers->set('Content-Security-Policy', "frame-ancestors 'self' https://www.gsvgroningen.nl");
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        return $response;
    }
}
