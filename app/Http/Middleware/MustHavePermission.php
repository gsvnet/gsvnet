<?php namespace GSV\Http\Middleware;

use Closure;
use GSVnet\Permissions\NoPermissionException;
use GSVnet\Permissions\Permission;

class MustHavePermission {

	public function handle($request, Closure $next, $permission = 'test')
	{
		if(! Permission::has($permission))
			throw new NoPermissionException;

		return $next($request);
	}
}