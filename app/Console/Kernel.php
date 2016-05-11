<?php namespace GSV\Console;

use GSV\Console\Commands\BulkNewsletterSubscriptions;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        BulkNewsletterSubscriptions::class,
    ];
}
