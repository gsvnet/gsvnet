<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        $this->app->bind(
            'GSVnet\Albums\AlbumsRepositoryInterface',
            'GSVnet\Albums\DbAlbumsRepository'
        );

        $this->app->bind(
            'GSVnet\Albums\Photos\PhotosRepositoryInterface',
            'GSVnet\Albums\Photos\DbPhotosRepository'
        );

        $this->app->bind(
            'GSVnet\Files\FilesRepositoryInterface',
            'GSVnet\Files\DbFilesRepository'
        );

        $this->app->bind(
            'GSVnet\Files\Labels\LabelsRepositoryInterface',
            'GSVnet\Files\Labels\DbLabelsRepository'
        );

        $this->app->instance('GSVnet\Permissions\UserPermissionManager', function() {
            $user = Auth::user();
            return new GSVnet\Permissions\UserPermissionManager($user);
        });
    }

}