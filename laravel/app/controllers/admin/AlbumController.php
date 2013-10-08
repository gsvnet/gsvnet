<?php namespace Admin;

use BaseController;
use View;
use Model\Album;
use Model\Photo;

class AlbumController extends BaseController {
    public function index()
    {
        $albums = Album::paginate(10);

        $this->layout->content = View::make('admin.albums.index')->with('albums', $albums);
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function show($id)
    {
        $album = Album::find($id);
        $photos = Photo::where('album_id', '=', $id)->paginate(10);

        $this->layout->content = View::make('admin.albums.show')
            ->with('album', $album)
            ->with('photos', $photos);

    }

    public function edit($id)
    {
        # code...
    }

    public function update($id)
    {

    }

    public function destroy($id)
    {
        # code...
    }
}