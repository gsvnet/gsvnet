<?php namespace App\Http\Middleware;

use Closure;
use GSVnet\Permissions\UserAccountNotApprovedException;
use Illuminate\Contracts\Auth\Guard;

class AccountNotApproved {
    protected $auth;

    function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if(!$this->auth->user()->approved)
            throw new UserAccountNotApprovedException;

        return $next($request);
    }
}