<?php namespace Admin;

use BaseController;
use View;

use Model\Photo;
use Model\Album;

class PhotoController extends AdminController {
    public function index($id)
    {
        $album = Album::find($id);
        $photos = Photo::where('album_id', '=', $id)->paginate(10);

        $this->layout->content = View::make('admin.albums.show')
            ->with('album', $album)
            ->with('photos', $photos);
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function show($id)
    {

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