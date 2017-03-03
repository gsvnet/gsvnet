<?php namespace GSV\Providers;

use Collective\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

class BusServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @param Dispatcher|\Illuminate\Bus\Dispatcher $dispatcher
	 */
	public function boot(Dispatcher $dispatcher)
	{
		$dispatcher->mapUsing(function($command)
		{
			return Dispatcher::simpleMapping(
				$command, 'GSV\Commands', 'GSV\Handlers\Commands'
			);
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
