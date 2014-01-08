<?php namespace Admin;

use View;
use Model\Photo;
use Model\Album;
use Input;
use Validator;
use Str;
use Redirect;
use File;

class PhotoController extends BaseController {

    protected $photoHandler;

    public function __construct(PhotoHandler $photoHandler)
    {
        $this->photoHandler = $photoHandler;
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
            $photo->name     = Input::has('name') ? Input::get('name') : $file->getClientOriginalName();
            $photo->album_id = $input['album_id'];
            // Let the photo handler store our photo file
            $photo = $this->photoHandler->make($file, "/uploads/photos/album-" . $photo->album_id . "/");

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

    public function update($album_id, $id)
    {
        $photo = Photo::find($id);
        $input = Input::all();

        $input['album_id'] = $album_id;
        $rules = Photo::$rules;

        // To do : use $v->sometimes()
        if (Input::hasFile('photo'))
        {
            $file = $input['photo'] = Input::file('photo');
            $rules = array_add(Photo::$rules, 'photo', 'image');
        }

        // Validate photo name, album id and file type
        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $photo->name = Input::get('name');

            if (Input::hasFile('photo'))
            {
                $this->photoHandler->update($file, $photo->src_path);
            }

            $photo->save();

            return Redirect::action('Admin\AlbumController@show', $photo->album_id)
                ->with('message', '<strong>' . $photo->name . '</strong> is succesvol bewerkt.')
                ->with('changedID', $id);
        }

        return Redirect::back()
            ->withInput()
            ->withErrors($validation);

    }

    public function destroy($album_id, $id)
    {
        $photo = Photo::find($id);
        // Delete photo files
        $this->photoHandler->destroy($photo->src_path);
        // Delete photo entry
        $photo->delete();

        return Redirect::action('Admin\PhotoController@index')
            ->with('message', '<strong>' . $photo->name . '</strong> is succesvol verwijderd.');
    }

}