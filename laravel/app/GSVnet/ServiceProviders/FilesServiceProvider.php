<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use Route;

class FilesServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        $this->app->bind(
            'GSVnet\Files\FilesRepositoryInterface',
            'GSVnet\Files\DbFilesRepository'
        );

        $this->app->bind(
            'GSVnet\Files\Labels\LabelsRepositoryInterface',
            'GSVnet\Files\Labels\DbLabelsRepository'
        );

        Route::filter('files.show', 'GSVnet\Files\Filters\ShowFileFilter');
    }

}
