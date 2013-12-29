<?php namespace Admin;

use View;
use Model\Photo;
use Model\Album;
use Input;
use Validator;
use Str;
use Redirect;

class PhotoController extends BaseController {
    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => array('store', 'update', 'delete')]);
        parent::__construct();
    }

    public function index($id)
    {
        $album = Album::find($id);
        $photos = Photo::where('album_id', '=', $id)->paginate(10);

        $this->layout->content = View::make('admin.albums.show')
            ->with('album', $album)
            ->with('photos', $photos);
    }

    public function store($album_id)
    {
        $input = Input::all();
        $input['album_id'] = $album_id;
        $file = $input['photo'] = Input::file('photo');

        // Validate photo name, album id and file type
        $validation = Validator::make($input, array_add(Photo::$rules, 'photo', 'required|image'));

        if ($validation->passes())
        {
            $photo = new Photo();

            $photo->name = Input::has('name') ? Input::get('name') : $file->getClientOriginalName();

            $photo->album_id = $input['album_id'];

            $filename = time() . '-' . $file->getClientOriginalName();

            $file = $file->move(public_path() . '/uploads/photos/', $filename);

            $photo->src_path = '/uploads/photos/' . $filename;

            $photo->save();

            return Redirect::action('Admin\AlbumController@show', $album_id)
                ->with('message', '<strong>' . $photo->name . '</strong> is succesvol opgeslagen.')
                ->with('changedID', $photo->id);
        }

        return Redirect::back()->withInput()->withErrors($validation);
    }

    public function show($album_id, $id)
    {
        $photo = Photo::find($id);

        $this->layout->content = View::make('admin.photos.show')->withPhoto($photo);
    }

    public function edit($album_id, $id)
    {
        # code...
    }

    public function update($album_id, $id)
    {

    }

    public function destroy($album_id, $id)
    {
        $photo = Photo::find($id);
        $photo->delete();

        return Redirect::action('Admin\PhotoController@index')
            ->with('message', '<strong>' . $photo->name . '</strong> is succesvol verwijderd.');
    }

}