<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Helpers\Permissions\UserAccountNotApprovedException;
use Closure;

class AccountNotApproved
{
    protected $auth;

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()->approved) {
            throw new UserAccountNotApprovedException;
        }

        return $next($request);
    }
}
