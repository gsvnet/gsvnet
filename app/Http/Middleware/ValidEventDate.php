<?php namespace GSV\Http\Middleware;

use Closure;
use Config;

class ValidEventDate {

	public function handle($request, Closure $next)
	{
		$min = (int) Config::get('gsvnet.events.minYear');
		$max = (int) Config::get('gsvnet.events.maxYear');
		$months = Config::get('gsvnet.months');

		$year = (int) $request->route()->getParameter('year');
		$month = $request->route()->getParameter('month', '');

		if($year < $min or $year > $max)
			abort('404');

		if(!empty($month) && !array_key_exists($month, $months))
			abort('404');

		return $next($request);
	}
}

