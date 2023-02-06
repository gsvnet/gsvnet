<?php namespace GSV\Http\Middleware;

use Illuminate\Support\Facades\Gate;
use Closure;
use GSV\Helpers\Permissions\NoPermissionException;

class MustHavePermission {

	public function handle($request, Closure $next, $permission = 'test')
	{
		if(Gate::denies($permission))
			throw new NoPermissionException;

		return $next($request);
	}
}