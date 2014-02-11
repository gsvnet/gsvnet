<?php namespace GSVnet\Albums;

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
        Route::filter('album.show', 'GSVnet\Albums\Filters\ShowAlbumFilter');
        Route::filter('album.create', 'GSVnet\Albums\Albums\Filters\CreateAlbumFilter');
        Route::filter('album.update', 'GSVnet\Albums\Albums\Filters\UpdateAlbumFilter');
        Route::filter('album.delete', 'GSVnet\Albums\Albums\Filters\DeleteAlbumFilter');
        // Photo filters
        Route::filter('photo.show', 'GSVnet\Albums\Photos\Filters\ShowPhotoFilter');
        Route::filter('photo.create', 'GSVnet\Albums\Photos\Filters\CreatePhotoFilter');
        Route::filter('photo.update', 'GSVnet\Albums\Photos\Filters\UpdatePhotoFilter');
        Route::filter('photo.delete', 'GSVnet\Albums\Photos\Filters\DeletePhotoFilter');
    }
}