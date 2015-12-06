<?php namespace GSV\Http\Middleware;

use Closure;
use GSVnet\Permissions\NoPermissionException;
use GSVnet\Permissions\Permission;
use Illuminate\Contracts\Auth\Guard;

class CanBecomeMember {

    private $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if(! $this->auth->guest() && ! Permission::has('user.become-member'))
            throw new NoPermissionException;

        return $next($request);
    }
}