<?php

namespace App\Http\Middleware;

use App\Helpers\Permissions\NoPermissionException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

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
