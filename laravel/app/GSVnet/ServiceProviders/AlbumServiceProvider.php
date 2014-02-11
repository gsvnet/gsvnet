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

        Route::filter('photo.show', 'GSVnet\Albums\Photo\ShowPhotoFilter');
        Route::filter('album.show', 'GSVnet\Albums\ShowAlbumFilter');
    }
}