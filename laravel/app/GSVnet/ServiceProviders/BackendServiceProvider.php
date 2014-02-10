<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use GSVnet\Permissions\PermissionChecker;
use App;

class BackendServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        // $this->app->bind(
        //     'GSVnet\Albums\AlbumsRepositoryInterface',
        //     'GSVnet\Albums\DbAlbumsRepository'
        // );

        // $this->app->bind(
        //     'GSVnet\Albums\Photos\PhotosRepositoryInterface',
        //     'GSVnet\Albums\Photos\DbPhotosRepository'
        // );

        $this->app->bind(
            'GSVnet\Files\FilesRepositoryInterface',
            'GSVnet\Files\DbFilesRepository'
        );

        $this->app->bind(
            'GSVnet\Files\Labels\LabelsRepositoryInterface',
            'GSVnet\Files\Labels\DbLabelsRepository'
        );

        // Permission services
        $this->app->bind('GSVnet\Permissions\PermissionManagerInterface', 'GSVnet\Permissions\FalsePermissionManager');
        $this->app->bind(
            'GSVnet\Permissions\PermissionChecker',
            function() {
                $manager = App::make('GSVnet\Permissions\PermissionManagerInterface');;
                return new \GSVnet\Permissions\PermissionChecker($manager);
            }
        );


        // $this->app->instance('GSVnet\Permissions\UserPermissionManager', function() {
        //     $user = Auth::user();
        //     return new GSVnet\Permissions\UserPermissionManager($user);
        // });
    }

}