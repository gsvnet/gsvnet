<?php

use Model\Album;
use Model\Photo;

use GSVnet\Services\ImageHandler;
use GSVnet\Repos\AlbumsRepositoryInterface;
use GSVnet\Repos\PhotosRepositoryInterface;

class PhotoController extends BaseController {
    protected $imageHandler;
    protected $albums;
    protected $photos;

    public function __construct(
        ImageHandler $imageHandler,
        AlbumsRepositoryInterface $albums,
        PhotosRepositoryInterface $photos)
    {
        $this->imageHandler = $imageHandler;
        $this->albums = $albums;
        $this->photos = $photos;

        $this->beforeFilter('csrf', ['only' => array('store', 'update', 'delete')]);
        parent::__construct();
    }

	public function showAlbums()
	{
        $photosPerPage = Config::get('photos.photos_per_page');
        $albums = $this->albums->paginate($photosPerPage);

		$this->layout->content = View::make('gallery.albums.index')->with('albums', $albums);
	}

    public function showPhotos($slug)
    {
        $album = $this->albums->bySlug($slug);
        // Get the album's photos
        $photosPerPage = Config::get('photos.photos_per_page');
        $photos = $this->photos->byAlbumIdAndPaginate($album->id, $photosPerPage);

        $this->layout->content = View::make('gallery.albums.show')
            ->withAlbum($album)
            ->withPhotos($photos);
    }


    // ToDO:
    // Check if current user has rights to view phxoto

    // Show original (resized) photo
    public function showPhoto($id)
    {
        return $this->photoResponse($id);
    }

    // Show wide photo
    public function showPhotoWide($id)
    {
        return $this->photoResponse($id, 'wide');
    }

    // Show small photo
    public function showPhotoSmall($id)
    {
        return $this->photoResponse($id, 'small');
    }

    /**
    *
    *   Returns an image response
    *
    *   @param int $id
    *   @param string $type ('', 'small', or 'wide')
    */
    private function photoResponse($id, $type = '')
    {
        $photo = $this->photos->byId($id);

        $image = $this->imageHandler->get($photo->src_path, $type);
        return $image->response();
    }
}