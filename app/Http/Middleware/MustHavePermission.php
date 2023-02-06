<?php

namespace App\Http\Middleware;

use App\Helpers\Permissions\NoPermissionException;
use Closure;
use Illuminate\Support\Facades\Gate;

class MustHavePermission
{
    public function handle($request, Closure $next, $permission = 'test')
    {
        if (Gate::denies($permission)) {
            throw new NoPermissionException;
        }

        return $next($request);
    }
}
