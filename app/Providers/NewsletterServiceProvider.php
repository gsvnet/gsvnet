<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NewsletterServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Helpers\Newsletters\NewsletterList::class,
            \App\Helpers\Newsletters\Mailchimp\NewsletterList::class
        );
    }
}
