<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use App, Auth, Event, Route;

class BackendServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Sends email to user and admin group
        Event::listen('user.registered', 'GSVnet\Users\UserMailer@registered');
        Event::listen('user.activated', 'GSVnet\Users\UserMailer@activated');
        //
        Event::listen('potential.registered', 'GSVnet\Users\UserMailer@membership');
        Event::listen('potential.accepted', 'GSVnet\Users\UserMailer@membershipAccepted');

        Event::listen('user.updated', 'GSVnet\Newsletters\NewsletterManager@userUpdated');
        Event::listen('profile.updatedByOwner', 'GSVnet\Users\UserMailer@updatedByOwner');
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