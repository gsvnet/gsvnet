<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use App;
use Auth;

class BackendServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        $this->app->bind('permission', function()
        {
            $user = Auth::user();
            $committees = App::make('GSVnet\Committees\CommitteesRepository');

            // return App::make('GSVnet\Permissions\PermissionManager');
            return new \GSVnet\Permissions\PermissionManager($user, $committees);
        });


        // $this->app->instance('GSVnet\Permissions\UserPermissionManager', function() {
        //     $user = Auth::user();
        //     return new GSVnet\Permissions\UserPermissionManager($user);
        // });
    }

}