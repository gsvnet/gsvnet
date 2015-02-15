<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NewsletterServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'GSVnet\Newsletters\NewsletterList',
            'GSVnet\Newsletters\Mailchimp\NewsletterList'
        );
    }
}