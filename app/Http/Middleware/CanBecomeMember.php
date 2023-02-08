<?php

namespace App\Http\Middleware;

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

    public function handle($request, Closure $next)
    {
        if (! $this->auth->guest() && Gate::denies('user.become-member')) {
            throw new NoPermissionException;
        }

        return $next($request);
    }
}
