<?php namespace GSV\Providers;

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
            'GSV\Helpers\Newsletters\NewsletterList',
            'GSV\Helpers\Newsletters\Mailchimp\NewsletterList'
        );
    }
}