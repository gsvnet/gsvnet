<?php namespace GSVnet\Repos;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        $this->app->bind(
            'GSVnet\Repos\AlbumsRepositoryInterface',
            'GSVnet\Repos\DbAlbumsRepository'
        );

        $this->app->bind(
            'GSVnet\Repos\PhotosRepositoryInterface',
            'GSVnet\Repos\DbPhotosRepository'
        );

        $this->app->bind(
            'GSVnet\Repos\FilesRepositoryInterface',
            'GSVnet\Repos\DbFilesRepository'
        );

        $this->app->bind(
            'GSVnet\Repos\LabelsRepositoryInterface',
            'GSVnet\Repos\DbLabelsRepository'
        );

        $this->app->instance('GSVnet\Permissions\UserPermissionManager', function() {
            $user = Auth::user();
            return new GSVnet\Permissions\UserPermissionManager($user);
        });
    }

}