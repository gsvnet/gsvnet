<?php namespace GSV\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;

class SetLoggedInCookie {

    protected $auth;
    private $cookie;

    const LOGIN_COOKIE = 'logged-in';

    public function __construct(Guard $auth, CookieJar $cookie)
    {
        $this->auth = $auth;
        $this->cookie = $cookie;
    }

    public function handle(Request $request, Closure $next)
    {
        // Log user out if he has no cookie
        // This is a protection for accidental caching of private views
        if($this->auth->check() && ! $this->isCookieValid($request))
        {
            $this->auth->logout();
        }

        return $next($request);
    }

    private function isCookieValid(Request $request)
    {
        $cookie = $request->cookie(self::LOGIN_COOKIE);
        return $this->auth->user()->id == $cookie;
    }
}