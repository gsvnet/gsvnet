<?php

use GSVnet\Albums\AlbumsRepositoryInterface;
use GSVnet\Albums\Photos\PhotosRepositoryInterface;
use GSVnet\Albums\Photos\ImageHandler;

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
        // TODO: set up filtering
        $this->beforeFilter('albums.show', ['only' => ['showPhotos','showPhoto', 'showPhotoWide', 'showPhotoSmall']]);

        parent::__construct();
    }

	public function showAlbums()
	{
        $photosPerPage = Config::get('photos.photos_per_page');
        $albums = $this->albums->paginateWithFirstPhoto($photosPerPage);

        $this->layout->bodyID = 'albums-page';
		$this->layout->content = View::make('gallery.albums.index')->with('albums', $albums);
	}

    public function showPhotos($slug)
    {
        $album = $this->albums->bySlug($slug);
        // Get the album's photos
        $photosPerPage = Config::get('photos.photos_per_page');
        $photos = $this->photos->byAlbumIdAndPaginate($album->id, $photosPerPage);

        $this->layout->bodyID = 'album-page';
        $this->layout->content = View::make('gallery.albums.show')
            ->withAlbum($album)
            ->withPhotos($photos);
    }


    // ToDO:
    // Check if current user has rights to view phxoto

    // Show original (resized) photo
    public function showPhoto($album_id, $id)
    {
        return $this->photoResponse($id);
    }

    // Show wide photo
    public function showPhotoWide($album_id, $id)
    {
        return $this->photoResponse($id, 'wide');
    }

    // Show small photo
    public function showPhotoSmall($album_id, $id)
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