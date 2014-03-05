<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use App;
use Auth;
use Event;

class BackendServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('user.registered', 'GSVnet\Users\UserMailer@welcome');
    }

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