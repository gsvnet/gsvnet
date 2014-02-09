<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Albums\Photos\PhotoManager;
use GSVnet\Albums\Photos\PhotosRepositoryInterface;

use GSVnet\Core\ValidationException;
use GSVnet\Albums\Photos\PhotoStorageException;

class PhotoController extends BaseController {

    protected $photos;
    protected $manager;

    public function __construct(
        PhotosRepositoryInterface $photos,
        PhotoManager $manager)
    {
        $this->photos = $photos;
        $this->manager = $manager;

        $this->beforeFilter('maxUploadSize', ['only' => array('store', 'update')]);
        $this->beforeFilter('csrf', ['only' => array('store', 'update', 'delete')]);
        parent::__construct();
    }

    public function store($album_id)
    {
        $input = Input::all();
        $input['album_id'] = $album_id;
        $input['photo'] = Input::file('photo');

        try {
            $photo = $this->manager->create($input);

            $message = '<strong>' . $photo->name . '</strong> is succesvol opgeslagen.';
            return Redirect::action('Admin\AlbumController@show', $album_id)
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\AlbumController@show', $album_id)
                ->withInput()
                ->withErrors($e->getErrors());
        }
        catch (PhotoStorageException $e)
        {
            return Redirect::action('Admin\AlbumController@show', $album_id)
                ->withInput()
                ->withErrors("Er ging iets mis tijdens het uploaden, probeer het opnieuw. (misschien is het geuploade bestand te groot?)");
        }
    }

    public function show($album_id, $id)
    {
        $photo = $this->photos->byId($id);

        $this->layout->content = View::make('admin.photos.show')->withPhoto($photo);
    }

    public function update($album_id, $id)
    {
        $input = Input::all();
        $input['album_id'] = $album_id;
        $input['photo'] = Input::file('photo');

        try {
            $photo = $this->manager->update($id, $input);

            $message = '<strong>' . $photo->name . '</strong> is succesvol opgeslagen.';
            return Redirect::action('Admin\AlbumController@show', $album_id)
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\AlbumController@show', $album_id)
                ->withInput()
                ->withErrors($e->getErrors());
        }
        catch (PhotoStorageException $e)
        {
            return Redirect::action('Admin\AlbumController@show', $album_id)
                ->withInput()
                ->withErrors("Er ging iets mis tijdens het uploaden, probeer het opnieuw. (misschien is het geuploade bestand te groot?)");
        }
    }

    public function destroy($album_id, $id)
    {
        $photo = $this->manager->destroy($id);

        $message = '<strong>' . $photo->name . '</strong> is succesvol verwijderd.';
        return Redirect::action('Admin\AlbumController@show', $album_id)
            ->withMessage($message);
    }

}