<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class CommitteesServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        $this->app->bind(
            'GSVnet\Committees\CommitteesRepositoryInterface',
            'GSVnet\Committees\DbCommitteesRepository'
        );

        // Album filters
        // Route::filter('albums.show', 'GSVnet\Albums\Filters\ShowAlbumFilter');
    }
}