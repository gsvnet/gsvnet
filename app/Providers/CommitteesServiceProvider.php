<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CommitteesServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        // Album filters
        // Route::filter('albums.show', 'GSVnet\Albums\Filters\ShowAlbumFilter');
    }
}