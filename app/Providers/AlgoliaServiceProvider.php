<?php

namespace App\Providers;

use AlgoliaSearch\Client;
use Illuminate\Support\ServiceProvider;

class AlgoliaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Client::class, function () {
            return new Client(
                config('algolia.application'),
                config('algolia.key')
            );
        });
    }
}
