<?php namespace GSV\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'GSV\Console\Commands\BulkNewsletterSubscriptions',
		'GSV\Console\Commands\Forum',
        'GSV\Console\Commands\Exodus'
	];
}
