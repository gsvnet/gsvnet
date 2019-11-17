<?php namespace GSV\Http\Middleware;

use GSVnet\Core\Exceptions\CSPException;
use Closure;

class FrameGuard
{
    /**
     * Handle the given request and get the response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next)
    {
        /* 
            Temporary CSP
            
            Todo after the new front page has been implemented:
            - Implement proper, much more extensive CSP from https://github.com/spatie/laravel-csp
        */
        
        $response = $next($request);

        return $response->withHeaders([
            'Content-Security-Policy' => "frame-ancestors 'none'",
            'X-Frame-Options' => 'deny'
        ]);
    }
}
