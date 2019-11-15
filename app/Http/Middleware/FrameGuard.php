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
            Temporarily handle exception for gsvg.nl to allow us to redirect traffic unwillingly brought in by the VGST
            
            Todo after the new front page has been implemented:
            - Implement proper, much more extensive CSP from https://github.com/spatie/laravel-csp
        */
        function getDomain($url) {
            $pieces = parse_url($url);
            $domain = isset($pieces['host']) ? $pieces['host'] : '';
            if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
                return $regs['domain'];
            }
            return FALSE;
        }
        $referer = getDomain(url()->previous());
        if($referer == "gsvg.nl") {
            throw new CSPException;
        }
        
        $response = $next($request);

        $response->headers->set('Content-Security-Policy', 'frame-ancestors *.gsvg.nl');
        //$response->headers->set('X-Frame-Options', 'SAMEORIGIN', false);

        return $response;
    }
}
