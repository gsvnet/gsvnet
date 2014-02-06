<?php namespace GSVnet\Repos;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        $this->app->bind(
            'GSVnet\Repos\PhotosRepositoryInterface',
            'GSVnet\Repos\DbPhotosRepository'
        );
    }

}