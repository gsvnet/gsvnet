<?php namespace GSV\Http\Middleware;

use Closure;
use GSVnet\Permissions\UserAccountNotApprovedException;

class AccountNotApproved {
    protected $auth;

    public function handle($request, Closure $next)
    {
        if(! $request->user()->approved)
            throw new UserAccountNotApprovedException;

        return $next($request);
    }
}