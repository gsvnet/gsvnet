<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Helpers\Permissions\NoPermissionException;
use Closure;
use Illuminate\Support\Facades\Gate;

class MustHavePermission
{
    public function handle(Request $request, Closure $next, $permission = 'test'): Response
    {
        if (Gate::denies($permission)) {
            throw new NoPermissionException;
        }

        return $next($request);
    }
}
