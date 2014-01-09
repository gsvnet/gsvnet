<?php

use Model\Album;
use Model\Photo;

class PhotoController extends BaseController {
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

        return Response::image($photo->image); //, 200, ['Content-Type' => 'image/jpg']);
    }

    // Return an image object
    public function showPhotoWide($photo)
    {
        $photo = Photo::find($photo);

        return Response::image($photo->wide_image); //, 200, ['Content-Type' => 'image/jpg']);
    }

    // Return an image object
    public function showPhotoSmall($photo)
    {
        $photo = Photo::find($photo);

        return Response::image($photo->small_image); //, 200, ['Content-Type' => 'image/jpg']);
    }

}