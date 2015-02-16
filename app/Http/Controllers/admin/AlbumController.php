<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Albums\AlbumsRepository;
use GSVnet\Albums\AlbumValidator;

use GSVnet\Core\ImageHandler;
use GSVnet\Albums\Photos\PhotosRepository;

class AlbumController extends AdminBaseController {

    protected $albums;
    protected $photos;
    protected $validator;

    public function __construct(
        AlbumsRepository $albums,
        PhotosRepository $photos,
        AlbumValidator $validator)
    {
        $this->albums = $albums;
        $this->photos = $photos;
        $this->validator = $validator;

        $this->beforeFilter('albums.manage');

        parent::__construct();
    }

    public function index()
    {
        $albums = $this->albums->paginate(10);

        return view('admin.albums.index')->with('albums', $albums);
    }

    public function store()
    {
        $input = Input::all();
        $input['public'] = Input::get('public', false);

        $this->validator->validate($input);
        $album = $this->albums->create($input);

        $message = '<strong>' . $album->name . '</strong> is succesvol opgeslagen.';
        return redirect()->action('Admin\AlbumController@index')
            ->withMessage($message);
    }

    public function show($id)
    {
        $album = $this->albums->byId($id);

        $photosPerPage = 10;
        $photos = $this->photos->byAlbumIdAndPaginate($id, $photosPerPage);

        return view('admin.albums.show')
            ->withAlbum($album)
            ->withPhotos($photos);
    }

    public function edit($id)
    {
        $album = $this->albums->byId($id);

        return view('admin.albums.edit')
            ->withAlbum($album);
    }

    public function update($id)
    {
        $input = Input::all();
        $input['public'] = Input::get('public', false);

        $this->validator->validate($input);
        $album = $this->albums->update($id, $input);

        $message = '<strong>' . $album->name . '</strong> is succesvol bewerkt.';
        return redirect()->action('Admin\AlbumController@show', $id)
            ->withMessage($message);
    }

    public function destroy($id)
    {
        $album = $this->albums->delete($id);

        return redirect()->action('Admin\AlbumController@index')
            ->with('message', '<strong>' . $album->name . '</strong> is succesvol verwijderd.');
    }
}