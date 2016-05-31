<?php namespace GSV\Console;

use GSV\Console\Commands\BulkNewsletterSubscriptions;
use GSV\Console\Commands\InviteViaCLI;
use GSV\Console\Commands\StandardizePhoneNumbers;
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
        InviteViaCLI::class,
        StandardizePhoneNumbers::class,
    ];
}
