<?php namespace Admin;

use GSVnet\Albums\Photos\PhotoManager;
use GSVnet\Albums\Photos\PhotosRepository;
use Request;
use Input;

class PhotoController extends AdminBaseController {

    protected $photos;
    protected $manager;

    public function __construct(PhotosRepository $photos, PhotoManager $manager)
    {
        $this->photos = $photos;
        $this->manager = $manager;

        $this->beforeFilter('photos.manage');
        parent::__construct();
    }

    public function store($album_id)
    {
        $input = Input::all();
        $input['album_id'] = $album_id;
        $input['photo'] = Input::file('photo');

        $photo = $this->manager->create($input);

        // Check request type
        if(Request::ajax())
            return response()->json('success', 200);

        $message = '<strong>' . $photo->name . '</strong> is succesvol opgeslagen.';

        return redirect()->action('Admin\AlbumController@show', $album_id)->withMessage($message);
    }

    public function show($album_id, $id)
    {
        $photo = $this->photos->byId($id);

        return view('admin.photos.show')->withPhoto($photo);
    }

    public function update($album_id, $id)
    {
        $input = Input::all();
        $input['album_id'] = $album_id;
        $input['photo'] = Input::file('photo');

        $photo = $this->manager->update($id, $input);

        $message = '<strong>' . $photo->name . '</strong> is succesvol opgeslagen.';
        return redirect()->action('Admin\AlbumController@show', $album_id)
            ->withMessage($message);
    }

    public function destroy($album_id, $id)
    {
        $photo = $this->manager->destroy($id);

        $message = '<strong>' . $photo->name . '</strong> is succesvol verwijderd.';
        return redirect()->action('Admin\AlbumController@show', $album_id)
            ->withMessage($message);
    }

}