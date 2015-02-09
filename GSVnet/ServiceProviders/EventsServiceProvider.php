<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use View;

class EventsServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        View::composer('events.sidebar', 'GSVnet\Events\EventsSideBarComposer');
    }
}