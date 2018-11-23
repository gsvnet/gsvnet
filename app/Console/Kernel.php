<?php namespace GSV\Console;

use GSV\Console\Commands\BulkNewsletterSubscriptions;
use GSV\Console\Commands\BulkSyncWithAlgolia;
use GSV\Console\Commands\InviteViaCLI;
use GSV\Console\Commands\StandardizeAddresses;
use GSV\Console\Commands\StandardizePhoneNumbers;
use GSV\Events\Members\MemberFileWasCreated;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use GSVnet\Users\MemberFiler;
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
        // php7.0-zip had to be installed

        // The Excel package and Laravel's Storage use slightly different file system perspectives.
        $excelFolder = storage_path('app/ledenbestanden/');
        $excelFolderStorage = 'ledenbestanden';

        $schedule->call(function () use ($excelFolder) {
            $rawExcel = $this->filer->fileMembers();
            $storageInfo = $rawExcel->store('xlsx', $excelFolder, true);
            $filePath = $storageInfo['full'];

            event(new MemberFileWasCreated($filePath));
        })->daily();

        // Clean up the member file.
        $schedule->call(function () use ($excelFolderStorage) {
            Storage::deleteDirectory($excelFolderStorage);
        })->dailyAt('1:00');
    }
}
