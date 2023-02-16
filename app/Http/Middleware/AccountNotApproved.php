<?php

namespace App\Http\Middleware;

use App\Helpers\Permissions\UserAccountNotApprovedException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
