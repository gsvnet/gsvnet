<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use Route;

class AlbumServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        // Album filters
        Route::filter('albums.show', 'GSVnet\Albums\Filters\ShowAlbumFilter');
        Route::filter('albums.create', 'GSVnet\Albums\Filters\CreateAlbumFilter');
        Route::filter('albums.update', 'GSVnet\Albums\Filters\UpdateAlbumFilter');
        Route::filter('albums.delete', 'GSVnet\Albums\Filters\DeleteAlbumFilter');
        // Photo filters
        Route::filter('photos.show', 'GSVnet\Albums\Photos\Filters\ShowPhotoFilter');
        Route::filter('photos.create', 'GSVnet\Albums\Photos\Filters\CreatePhotoFilter');
        Route::filter('photos.update', 'GSVnet\Albums\Photos\Filters\UpdatePhotoFilter');
        Route::filter('photos.delete', 'GSVnet\Albums\Photos\Filters\DeletePhotoFilter');
    }
}