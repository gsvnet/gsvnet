<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Helpers\Permissions\NoPermissionException;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Gate;

class CanBecomeMember
{
    private $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->auth->guest() && Gate::denies('user.become-member')) {
            throw new NoPermissionException;
        }

        return $next($request);
    }
}
