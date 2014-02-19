<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use Route;

class FilesServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        Route::filter('files.show', 'GSVnet\Files\Filters\ShowFileFilter');
    }

}
