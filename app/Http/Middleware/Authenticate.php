<?php namespace GSV\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Auth::guest()) {
			if ($request->ajax()) {
				return response('Unauthorized.', 401);
			} else {
				return redirect()->guest(action('SessionController@getLogin'));
			}
		}
		return $next($request);
	}

}
