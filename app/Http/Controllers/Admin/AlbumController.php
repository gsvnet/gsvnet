<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Albums\AlbumsRepository;
use GSVnet\Albums\AlbumValidator;
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

        $this->authorize('photos.manage');

        parent::__construct();
    }

    public function index()
    {
        $albums = $this->albums->paginate(25);

        return view('admin.albums.index')->with('albums', $albums);
    }

    public function store()
    {
        $input = Input::all();
        $input['public'] = Input::get('public', false);

        $this->validator->validate($input);
        $album = $this->albums->create($input);

        flash()->success("Album {$album->name} is succesvol opgeslagen");

        return redirect()->action('Admin\AlbumController@index');
    }

    public function show($id)
    {
        $album = $this->albums->byId($id);

        $photosPerPage = 12;
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

        flash()->success("Album {$album->name} is succesvol bewerkt");

        return redirect()->action('Admin\AlbumController@show', $id);
    }

    public function destroy($id)
    {
        $album = $this->albums->delete($id);

        flash()->success("Album {$album->name} is succesvol verwijderd");

        return redirect()->action('Admin\AlbumController@index');
    }
}