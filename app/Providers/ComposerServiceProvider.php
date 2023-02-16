<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot(): void
    {
        View::composer('layouts.default', \App\Helpers\Core\Composers\NavigationViewComposer::class);
    }

    public function register(): void
    {
    }
}
