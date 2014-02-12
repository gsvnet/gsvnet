<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Albums\AlbumsRepositoryInterface;
use GSVnet\Albums\AlbumValidator;

use GSVnet\Albums\Photos\ImageHandler;
use GSVnet\Albums\Photos\PhotosRepositoryInterface;

use GSVnet\Core\Exceptions\ValidationException;

class AlbumController extends BaseController {

    protected $albums;
    protected $photos;
    protected $validator;

    public function __construct(
        AlbumsRepositoryInterface $albums,
        PhotosRepositoryInterface $photos,
        AlbumValidator $validator)
    {
        $this->albums = $albums;
        $this->photos = $photos;
        $this->validator = $validator;

        $this->beforeFilter('csrf', ['only' => ['store', 'update', 'delete']]);
        $this->beforeFilter('albums.create', ['on' => 'store']);
        $this->beforeFilter('albums.update', ['only' => ['update', 'edit']]);
        $this->beforeFilter('albums.delete', ['on' => 'destroy']);

        parent::__construct();
    }

    public function index()
    {
        $albums = $this->albums->paginate(10);

        $this->layout->content = View::make('admin.albums.index')->with('albums', $albums);
    }

    public function store()
    {
        $input = Input::all();
        $input['public'] = Input::get('public', false);

        try
        {
            $this->validator->validate($input);
            $album = $this->albums->create($input);

            $message = '<strong>' . $album->name . '</strong> is succesvol opgeslagen.';
            return Redirect::action('Admin\AlbumController@index')
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\AlbumController@index')
                ->withInput()
                ->withErrors($e->getErrors());
        }
    }

    public function show($id)
    {
        $album = $this->albums->byId($id);

        $photosPerPage = 10;
        $photos = $this->photos->byAlbumIdAndPaginate($id, $photosPerPage);

        $this->layout->content = View::make('admin.albums.show')
            ->withAlbum($album)
            ->withPhotos($photos);
    }

    public function edit($id)
    {
        $album = $this->albums->byId($id);

        $this->layout->content = View::make('admin.albums.edit')
            ->withAlbum($album);
    }

    public function update($id)
    {
        $input = Input::all();
        $input['public'] = Input::get('public', false);

        try
        {
            $this->validator->validate($input);
            $album = $this->albums->update($id, $input);

            $message = '<strong>' . $album->name . '</strong> is succesvol bewerkt.';
            return Redirect::action('Admin\AlbumController@show', $id)
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\AlbumController@edit', $id)
                ->withInput()
                ->withErrors($e->getErrors());
        }
    }

    public function destroy($id)
    {
        $album = $this->albums->delete($id);

        return Redirect::action('Admin\AlbumController@index')
            ->with('message', '<strong>' . $album->name . '</strong> is succesvol verwijderd.');
    }
}