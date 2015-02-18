<?php namespace GSV\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
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
				return redirect('/', 403);
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
				App::abort('404');

			if(!empty($month) && !array_key_exists($month, $months))
				App::abort('404');
		});

		/**
		 * Check if a user has certain abilities specified in de User model
		 */
		Route::filter('has', function($route, $request, $permission)
		{
			if(! Permission::has($permission))
				throw new \GSVnet\Permissions\NoPermissionException;
		});

		Route::filter('canBecomeMember', function()
		{
			if(Auth::check() && Auth::user()->wasOrIsMember() )
			    throw new \GSVnet\Permissions\NoPermissionException;
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
