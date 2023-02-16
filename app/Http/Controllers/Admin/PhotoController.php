<?php

namespace Admin;

use App\Helpers\Albums\Photos\PhotoManager;
use App\Helpers\Albums\Photos\PhotosRepository;

use Request;

class PhotoController extends AdminBaseController
{
    protected $photos;

    protected $manager;

    public function __construct(PhotosRepository $photos, PhotoManager $manager)
    {
        $this->photos = $photos;
        $this->manager = $manager;

        $this->authorize('photos.manage');
        parent::__construct();
    }

    public function store($album_id)
    {
        $input = Request::all();
        $input['album_id'] = $album_id;
        $input['photo'] = Request::file('photo');

        $photo = $this->manager->create($input);

        // Check request type
        if (Request::ajax()) {
            return response()->json('success', 200);
        }

        flash()->success("{$photo->name} is succesvol opgeslagen.");

        return redirect()->action('Admin\AlbumController@show', $album_id);
    }

    public function show($album_id, $id)
    {
        $photo = $this->photos->byId($id);

        return view('admin.photos.show')->with('photo', $photo);
    }

    public function update($album_id, $id)
    {
        $input = Request::all();
        $input['album_id'] = $album_id;
        $input['photo'] = Request::file('photo');

        $photo = $this->manager->update($id, $input);

        flash()->success("{$photo->name} is succesvol bijgewerkt.");

        return redirect()->action('Admin\AlbumController@show', $album_id);
    }

    public function destroy($album_id, $id)
    {
        $photo = $this->manager->destroy($id);

        flash()->success("{$photo->name} is succesvol verwijderd.");

        return redirect()->action('Admin\AlbumController@show', $album_id);
    }
}
