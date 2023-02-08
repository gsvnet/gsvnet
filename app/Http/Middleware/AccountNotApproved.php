<?php

namespace App\Http\Middleware;

use App\Helpers\Permissions\UserAccountNotApprovedException;
use Closure;

class AccountNotApproved
{
    protected $auth;

    public function handle($request, Closure $next)
    {
        if (! $request->user()->approved) {
            throw new UserAccountNotApprovedException;
        }

        return $next($request);
    }
}
