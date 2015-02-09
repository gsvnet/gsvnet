<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use GSVnet\Permissions\Permission;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = null;

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		// Set locale to Dutch
		setlocale(LC_ALL, 'nl_NL.UTF-8');

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
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
