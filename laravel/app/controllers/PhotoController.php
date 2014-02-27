<?php

use GSVnet\Albums\AlbumsRepository;
use GSVnet\Albums\Photos\PhotosRepository;
use GSVnet\Core\ImageHandler;

class PhotoController extends BaseController {
    protected $imageHandler;
    protected $albums;
    protected $photos;

    public function __construct(
        ImageHandler $imageHandler,
        AlbumsRepository $albums,
        PhotosRepository $photos)
    {
        $this->imageHandler = $imageHandler;
        $this->albums = $albums;
        $this->photos = $photos;

        $this->beforeFilter('csrf', ['only' => array('store', 'update', 'delete')]);
        // TODO: set up filtering
        // $this->beforeFilter('albums.show', ['only' => ['showPhotos','showPhoto', 'showPhotoWide', 'showPhotoSmall']]);

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
        $response = $image->response();

        $path = $this->imageHandler->getStoragePath($photo->src_path, $type);
        $name = $photo->name;

         if (is_null($name)) {
            $name = basename($path);
        }

        $filetime = filemtime($path);
        $etag = md5($filetime . $path);
        $time = gmdate('r', $filetime);
        // Keep images 1 month
        $lifetime = 60*60*24*30;
        $expires = gmdate('r', $filetime + $lifetime);
        // $expires = '+1 month';
        $length = filesize($path);

        $headers = array(
            'Content-Disposition' => 'inline; filename="' . $name . '"',
            'Last-Modified' => $time,
            'Cache-Control' => 'must-revalidate',
            'Expires' => $expires,
            'Pragma' => 'public',
            'Etag' => $etag,
        );
        $headerTest1 = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $time;
        $headerTest2 = isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == $etag;
        //image is cached by the browser, we dont need to send it again
        if ($headerTest1 || $headerTest2) {
            return Response::make('', 304, $headers);
        }

        foreach ($headers as $header => $value) {
            $response->header($header, $value);
        }

        return $response;
    }
}