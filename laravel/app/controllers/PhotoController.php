<?php

class PhotoController extends BaseController {
	public function showAlbums()
	{
        $albums = Album::paginate(10);

		$this->layout->content = View::make('gallery.albums')->with('albums', $albums);
	}

}