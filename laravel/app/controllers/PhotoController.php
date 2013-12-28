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

        // $album = Model\Album::get($album)->with('photos');
        //
        $album = Album::where('slug', '=', $albumSlug)->first();
        //$photos = $album->photos()->paginate(10);

        $photos = Photo::where('album_id', '=', $album->id)->paginate(10);
        //$photos->setBaseUrl('custom/url');

        $this->layout->content = View::make('gallery.albums.show')
            ->with('album', $album)
            ->with('photos', $photos);
    }

}