<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	// Set locale to Dutch
	setlocale(LC_ALL, 'nl_NL.UTF-8');
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest(action('SessionController@getLogin'));
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to(action('UserController@showProfile'));
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/**
 * Check if a user has certain abilities specified in de User model
 */
Route::filter('can', function($route, $request, $action)
{
	if(!Auth::user()->can($action))
	{
		//Session::flash('error', 'Niet genoeg rechten.');
		return Redirect::to('/');
	}
});

/**
 * Check user type
 */
Route::filter('usertype', function($route, $request, $type)
{
	$types = Config::get('gsvnet.userTypes');

	// Check if type exists.
	if(!in_array($type, $types))
	{
		die('Verkeerd type');
	}

	// Check if user has correct type.
	if(!Auth::user()->type == $types[$type])
	{
		return Redirect::to('/');
	}
});

/*
|--------------------------------------------------------------------------
| Max Upload Size filter
|--------------------------------------------------------------------------
|
| Check if a user uploaded a file larger than the max size limit.
| This filter is used when we also use a CSRF filter and don't want
| to get a TokenMismatchException due to $_POST and $_GET being cleared.
|
*/
Route::filter('maxUploadSize', function()
{
    // Check if upload has exceeded max size limit
    if (! (Request::isMethod('POST') or Request::isMethod('PUT'))) { return; }
    // Get the max upload size (in Mb, so convert it to bytes)
    $maxUploadSize = 1024 * 1024 * ini_get('post_max_size');
    $contentSize = 0;
    if (isset($_SERVER['HTTP_CONTENT_LENGTH']))
    {
        $contentSize = $_SERVER['HTTP_CONTENT_LENGTH'];
    }
    elseif (isset($_SERVER['CONTENT_LENGTH']))
    {
        $contentSize = $_SERVER['CONTENT_LENGTH'];
    }
    // If content exceeds max size, throw an exception
    if ($contentSize > $maxUploadSize)
    {
        throw new GSVnet\Core\Exceptions\MaxUploadSizeException;
    }
});

/**
 * Check if a year or month is requested which does not exist
 */

Route::filter('checkDate', function($route, $request)
{
	$min = (int) Config::get('gsvnet.events.minYear');
	$max = (int) Config::get('gsvnet.events.maxYear');
	$months = Config::get('gsvnet.months');

	$year = (int) $route->getParameter('year');
	$month = $route->getParameter('month', '');

	if($year < $min or $year > $max)
	{
		App::abort('404');
	}


	if(!empty($month) && !array_key_exists($month, $months))
	{
		App::abort('404');
	}

});

/**
 * Check if a user has certain abilities specified in de User model
 */
Route::filter('has', function($route, $request, $permission)
{
    if(! Permission::has($permission))
    {
        //Session::flash('error', 'Niet genoeg rechten.');
        throw new \GSVnet\Permissions\NoPermissionException;
    }
});

Route::filter('canBecomeMember', function()
{
	if(Auth::check() && Auth::user()->wasOrIsMember() )
	{
		// TODO: eigen exceptie?
		throw new \GSVnet\Permissions\NoPermissionException;
	}
});

// User has to be approved
Route::filter('approved', function() {

    if ( ! Auth::user()->approved)
    {
        throw new \GSVnet\Permissions\UserAccountNotApprovedException;
    }
});