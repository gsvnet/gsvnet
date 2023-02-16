<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set locale to Dutch
        setlocale(LC_ALL, 'nl_NL.UTF-8');
        Carbon::setLocale(config('app.locale'));
        Paginator::useBootstrapThree();

        Validator::extend(
            'recaptcha',
            'App\\Http\\Validators\\ReCaptcha@validate'
        );
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     */
    public function register(): void
    {
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            \App\Services\Registrar::class
        );
    }
}
