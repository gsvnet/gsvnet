<?php namespace GSV\Console;

use GSV\Console\Commands\BulkNewsletterSubscriptions;
use GSV\Console\Commands\BulkSyncWithAlgolia;
use GSV\Console\Commands\InviteViaCLI;
use GSV\Console\Commands\StandardizeAddresses;
use GSV\Console\Commands\StandardizePhoneNumbers;
use GSV\Console\Commands\CheckGravatars;
use GSV\Console\Commands\PromoteATVToMembers;
use Illuminate\Console\Scheduling\Schedule;
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
        StandardizeAddresses::class,
        BulkSyncWithAlgolia::class,
        CheckGravatars::class,
        PromoteATVToMembers::class
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command(CheckGravatars::class)->dailyAt('04:00');
    }
}
