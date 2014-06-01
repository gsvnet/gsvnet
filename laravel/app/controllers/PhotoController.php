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

        // $this->beforeFilter('csrf', ['only' => array('store', 'update', 'delete')]);
        // $this->beforeFilter('albums.show',
        //     ['only' => ['showPhotos']]
        // );

        // The corresponding photo should be public or the current use should have permission to show private phtoos
        // $this->beforeFilter('photos.show',
        //     ['only' => ['showPhoto', 'showPhotoWide', 'showPhotoSmall']]
        // );

        parent::__construct();
    }

	public function showAlbums()
	{
        $photosPerPage = Config::get('photos.photos_per_page');
        $albums = $this->albums->paginateWithFirstPhoto($photosPerPage);

        $this->layout->bodyID = 'albums-page';
        $this->layout->title = 'Fotoalbum';
        $this->layout->description = 'Bekijk hier foto\'s van soosavonden, sing-ins, kampen, weekenden, wedstrijden, lezingen en al wat de GSV nog meer te bieden heeft.';
        $this->layout->activeMenuItem = 'foto-album';
        $this->layout->content = View::make('gallery.albums.index')->with('albums', $albums);
    }

    public function showPhotos($slug)
    {
        $album = $this->albums->bySlug($slug);
        // Get the album's photos
        $photosPerPage = Config::get('photos.photos_per_page');
        $photos = $this->photos->byAlbumIdAndPaginate($album->id, $photosPerPage);


        $this->layout->title = $album->name;
        $this->layout->description = $album->description;

        $this->layout->bodyID = 'album-page';
        $this->layout->activeMenuItem = 'foto-album';
        $this->layout->content = View::make('gallery.albums.show')
            ->withAlbum($album)
            ->withPhotos($photos);
    }


    // ToDO:
    // Check if current user has rights to view phxoto

    /**
    *   Returns an image response
    *
    *   @param int $id
    *   @param string $type
    */
    public function showPhoto($photo_id, $type = '')
    {
        $photo = $this->photos->byId($photo_id);
        $path  = $this->imageHandler->getStoragePath($photo->src_path, $type);
        $name  = $photo->name;

        return Response::inlinePhoto($path, $name);
    }
}