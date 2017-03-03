<?php

use GSVnet\Albums\AlbumsRepository;
use GSVnet\Albums\Photos\PhotosRepository;
use GSVnet\Core\ImageHandler;
use Illuminate\Support\Facades\Config;

class PhotoController extends BaseController {
    private $albums;
    private $photos;
    private $handler;

    public function __construct(AlbumsRepository $albums, PhotosRepository $photos, ImageHandler $handler)
    {
        parent::__construct();
        $this->albums = $albums;
        $this->photos = $photos;
        $this->handler = $handler;
    }

	public function showAlbums()
	{
        $photosPerPage = Config::get('photos.photos_per_page');
        $albums = $this->albums->paginateWithFirstPhoto($photosPerPage);

        return view('gallery.albums.index')->with('albums', $albums);
    }

    public function showPhotos($slug)
    {
        $album = $this->albums->bySlug($slug);
        $photosPerPage = Config::get('photos.photos_per_page') - 1;
        $photos = $this->photos->byAlbumIdAndPaginate($album->id, $photosPerPage);

        return view('gallery.albums.show')
            ->withAlbum($album)
            ->withPhotos($photos);
    }


    /**
     * Returns an image response
     *
     * @param $photo_id
     * @param string $type
     * @return
     */
    public function showPhoto($photo_id, $type = '')
    {
        $photo = $this->photos->byId($photo_id);
        $path = $this->handler->getStoragePath($photo->src_path, $type);
        $name = $photo->name;

        return response()->inlinePhoto($path, $name);
    }
}