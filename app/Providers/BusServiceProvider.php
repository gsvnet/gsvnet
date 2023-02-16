<?php

namespace App\Providers;

use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

class BusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param  Dispatcher|\Illuminate\Bus\Dispatcher  $dispatcher
     */
    public function boot(Dispatcher $dispatcher): void
    {
        $dispatcher->map(['App\Handlers\Commands']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
