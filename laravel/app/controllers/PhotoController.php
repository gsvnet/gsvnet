<?php

class PhotoController extends BaseController {
	public function showAlbums()
	{
        $albums = Model\Album::paginate(10);

		$this->layout->content = View::make('gallery.album.index')->with('albums', $albums);
	}

    public function showPhotos($id)
    {
        // $album = Model\Album::get($id)->with('photos');
        //
        $album = Model\Album::find($id);
        //$photos = $album->photos()->paginate(10);

        $photos = Model\Photo::where('album_id', '=', $id)->paginate(10);
        //$photos->setBaseUrl('custom/url');

        $this->layout->content = View::make('gallery.album.show')
            ->with('album', $album)
            ->with('photos', $photos);
    }

}