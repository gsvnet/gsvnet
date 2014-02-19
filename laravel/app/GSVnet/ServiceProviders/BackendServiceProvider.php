<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use App;

class BackendServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        // Permission services
        $this->app->bind('GSVnet\Permissions\PermissionManagerInterface', 'GSVnet\Permissions\UserPermissionManager');
        $this->app->bind('permission', function()
        {
            return $this->app->make('GSVnet\Permissions\PermissionManagerInterface');
        });


        // $this->app->instance('GSVnet\Permissions\UserPermissionManager', function() {
        //     $user = Auth::user();
        //     return new GSVnet\Permissions\UserPermissionManager($user);
        // });
    }

}