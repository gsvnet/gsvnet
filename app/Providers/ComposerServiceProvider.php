<?php namespace GSV\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.default', 'GSV\Helpers\Core\Composers\NavigationViewComposer');
    }

    public function register(){}
}