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