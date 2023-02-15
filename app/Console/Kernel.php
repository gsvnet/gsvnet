<?php

namespace App\Console;

use App\Console\Commands\BulkNewsletterSubscriptions;
use App\Console\Commands\BulkSyncWithAlgolia;
use App\Console\Commands\InviteViaCLI;
use App\Console\Commands\MigrateFormerMembers;
use App\Console\Commands\StandardizeAddresses;
use App\Console\Commands\StandardizePhoneNumbers;
use App\Events\Members\MemberFileWasCreated;
use App\Helpers\Users\MemberFiler;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;

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
        MigrateFormerMembers::class,
    ];

    private $filer;

    public function __construct(Application $app, Dispatcher $events, MemberFiler $filer)
    {
        $this->filer = $filer;

        parent::__construct($app, $events);
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // The Excel package and Laravel's Storage use slightly different file system perspectives.
        $excelFolder = storage_path('app/ledenbestanden/');
        $excelFolderStorage = 'ledenbestanden';

        $schedule->call(function () use ($excelFolder) {
            $rawExcel = $this->filer->fileMembers();
            $storageInfo = $rawExcel->store('xlsx', $excelFolder, true);
            $filePath = $storageInfo['full'];

            event(new MemberFileWasCreated($filePath));
        })->monthly();

        // Clean up the member file.
        $schedule->call(function () use ($excelFolderStorage) {
            Storage::deleteDirectory($excelFolderStorage);
        })->monthlyOn(2);
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
