<?php

class PhotoController extends BaseController {
	public function showAlbums()
	{
		$this->layout->content = View::make('gallery.albums');
	}

}