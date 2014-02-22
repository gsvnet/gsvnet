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
            // $user       = Auth::user();
            // $auth       = App::make('Auth');
            $committees = App::make('GSVnet\Committees\CommitteesRepository');

            $manager = new \GSVnet\Permissions\PermissionManager($committees);
            $manager->setUser(Auth::user());

            return $manager;
        });
    }

}