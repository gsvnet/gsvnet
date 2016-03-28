<?php namespace GSV\Console;

use GSV\Console\Commands\BulkNewsletterSubscriptions;
use GSV\Console\Commands\Exodus;
use GSV\Console\Commands\Forum;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		BulkNewsletterSubscriptions::class,
		Forum::class,
		Exodus::class,
//		ImportMembers::class
	];
}
