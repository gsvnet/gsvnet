<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Closure;
use Config;

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
