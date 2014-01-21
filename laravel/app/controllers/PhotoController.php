<?php

use Model\Album;
use Model\Photo;
use GSVnet\Services\PhotoHandler;

class PhotoController extends BaseController {
    protected $photoHandler;

    public function __construct(PhotoHandler $photoHandler)
    {
        $this->photoHandler = $photoHandler;
        $this->beforeFilter('csrf', ['only' => array('store', 'update', 'delete')]);
        parent::__construct();
    }

	public function showAlbums()
	{
        $albums = Album::paginate(10);

		$this->layout->content = View::make('gallery.albums.index')->with('albums', $albums);
	}

    public function showPhotos($albumSlug)
    {
        $album = Album::where('slug', '=', $albumSlug)->first();
        $photos = Photo::where('album_id', '=', $album->id)->paginate(10);
        //$photos->setBaseUrl('custom/url');

        $this->layout->content = View::make('gallery.albums.show')
            ->with('album', $album)
            ->with('photos', $photos);
    }


    // ToDO:
    // Check if current user has rights to view phxoto

    // Return an image object
    public function showPhoto($photo)
    {
        $photo = Photo::find($photo);

        $image = $this->photoHandler->get($photo->src_path);
        return $image->response();
    }

    // Return an image object
    public function showPhotoWide($photo)
    {
        $photo = Photo::find($photo);

        $image = $this->photoHandler->get($photo->src_path, 'wide');
        return $image->response();
    }

    // Return an image object
    public function showPhotoSmall($photo)
    {
        $photo = Photo::find($photo);

        $image = $this->photoHandler->get($photo->src_path, 'small');
        return $image->response();
    }

}