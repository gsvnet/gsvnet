<?php namespace GSVnet\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use Route;

class AlbumServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        $this->app->bind(
            'GSVnet\Albums\AlbumsRepositoryInterface',
            'GSVnet\Albums\DbAlbumsRepository'
        );

        $this->app->bind(
            'GSVnet\Albums\Photos\PhotosRepositoryInterface',
            'GSVnet\Albums\Photos\DbPhotosRepository'
        );

        // Album filters
        Route::filter('albums.show', 'GSVnet\Albums\Filters\ShowAlbumFilter');
        Route::filter('albums.create', 'GSVnet\Albums\Albums\Filters\CreateAlbumFilter');
        Route::filter('albums.update', 'GSVnet\Albums\Albums\Filters\UpdateAlbumFilter');
        Route::filter('albums.delete', 'GSVnet\Albums\Albums\Filters\DeleteAlbumFilter');
        // Photo filters
        Route::filter('photos.show', 'GSVnet\Albums\Photos\Filters\ShowPhotoFilter');
        Route::filter('photos.create', 'GSVnet\Albums\Photos\Filters\CreatePhotoFilter');
        Route::filter('photos.update', 'GSVnet\Albums\Photos\Filters\UpdatePhotoFilter');
        Route::filter('photos.delete', 'GSVnet\Albums\Photos\Filters\DeletePhotoFilter');
    }
}