<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidEventDate
{
    public function handle(Request $request, Closure $next): Response
    {
        $min = (int) Config::get('gsvnet.events.minYear');
        $max = (int) Config::get('gsvnet.events.maxYear');
        $months = Config::get('gsvnet.months');

        $year = (int) $request->route('year');
        $month = $request->route('month', '');

        if ($year < $min or $year > $max) {
            abort('404');
        }

        if (! empty($month) && ! array_key_exists($month, $months)) {
            abort('404');
        }

        return $next($request);
    }
}
