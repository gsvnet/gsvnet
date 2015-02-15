<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;

class AlbumServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        // Album filters
        Route::filter('albums.show', 'GSVnet\Albums\Filters\ShowAlbumsFilter');
        Route::filter('albums.manage', 'GSVnet\Albums\Filters\ManageAlbumsFilter');

        // Photo filters
        Route::filter('photos.show', 'GSVnet\Albums\Photos\Filters\ShowPhotoFilter');
        Route::filter('photos.manage', 'GSVnet\Albums\Photos\Filters\ManagePhotosFilter');
    }
}