<?php namespace Admin;

use BaseController;
use View;
use Model\Album;
use Model\Photo;
use Input;
use Validator;
use Str;
use Redirect;

class AlbumController extends AdminController {

    public function __construct()
    {
        $this->layout = 'layouts.admin';
        $this->beforeFilter('csrf', ['only' => array('store', 'update', 'delete')]);
    }

    public function index()
    {
        $albums = Album::paginate(10);

        $this->layout->content = View::make('admin.albums.index')->with('albums', $albums);
    }

    public function store()
    {
        $input = Input::all();

        $validation = Validator::make($input, Album::$rules);

        if ($validation->passes())
        {
            $album = new Album();
            $album->name = $input['name'];
            $album->description = $input['description'];
            $album->save();

            $album->slug = $album->id . '-' . Str::slug($album->name);
            $album->save();

            return Redirect::action('Admin\AlbumController@index')
                ->with('message', '<strong>' . $album->name . '</strong> is succesvol opgeslagen.')
                ->with('changedID', $album->id);
        }

        return Redirect::back()->withInput()->withErrors($validation);
    }

    public function show($id)
    {
        $album = Album::find($id);

        $photos = Photo::where('album_id', '=', $album->id)->paginate(10);

        $this->layout->content = View::make('admin.albums.show')
            ->with('album', $album)
            ->with('photos', $photos);

    }

    public function edit($id)
    {
        $album = Album::find($id);

        $this->layout->content = View::make('admin.albums.edit')
            ->withAlbum($album);
    }

    public function update($id)
    {
        $input = Input::all();


        $validation = Validator::make($input, Album::$rules);

        if ($validation->passes())
        {
            $album = Album::findOrFail($id);

            $album->name = $input['name'];
            $album->description = $input['description'];
            $album->slug = $album->id . '-' . Str::slug($album->name);

            $album->save();

            return Redirect::action('Admin\AlbumController@index')
                ->with('message', '<strong>' . $album->name . '</strong> is succesvol bewerkt.')
                ->with('changedID', $id);
        }

        return Redirect::back()
            ->withInput()
            ->withErrors($validation);
    }

    public function destroy($id)
    {
        $album = Album::find($id);
        $album->delete();

        return Redirect::action('Admin\AlbumController@index')
            ->with('message', '<strong>' . $album->name . '</strong> is succesvol verwijderd.');
    }
}