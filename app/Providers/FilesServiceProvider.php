<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;

class FilesServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        Route::filter('files.show', 'GSVnet\Files\Filters\ShowFileFilter');
        Route::filter('files.manage', 'GSVnet\Files\Filters\ManageFilesFilter');
        Route::filter('files.pupblish', 'GSVnet\Files\Filters\PublishFilesFilter');
    }
}