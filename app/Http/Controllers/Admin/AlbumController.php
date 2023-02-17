<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Albums\AlbumsRepository;
use App\Helpers\Albums\AlbumValidator;
use App\Helpers\Albums\Photos\PhotosRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class AlbumController extends AdminBaseController
{
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

    public function index(): View
    {
        $albums = $this->albums->paginate(25);

        return view('admin.albums.index')->with('albums', $albums);
    }

    public function store(): RedirectResponse
    {
        $input = Request::all();
        $input['public'] = Request::get('public', false);

        $this->validator->validate($input);
        $album = $this->albums->create($input);

        flash()->success("Album {$album->name} is succesvol opgeslagen");

        return redirect()->action([\App\Http\Controllers\Admin\AlbumController::class, 'index']);
    }

    public function show($id): View
    {
        $album = $this->albums->byId($id);

        $photosPerPage = 12;
        $photos = $this->photos->byAlbumIdAndPaginate($id, $photosPerPage);

        return view('admin.albums.show')
            ->with('album', $album)
            ->with('photos', $photos);
    }

    public function edit($id): View
    {
        $album = $this->albums->byId($id);

        return view('admin.albums.edit')
            ->with('album', $album);
    }

    public function update($id): RedirectResponse
    {
        $input = Request::all();
        $input['public'] = Request::get('public', false);

        $this->validator->validate($input);
        $album = $this->albums->update($id, $input);

        flash()->success("Album {$album->name} is succesvol bewerkt");

        return redirect()->action([\App\Http\Controllers\Admin\AlbumController::class, 'show'], $id);
    }

    public function destroy($id): RedirectResponse
    {
        $album = $this->albums->delete($id);

        flash()->success("Album {$album->name} is succesvol verwijderd");

        return redirect()->action([\App\Http\Controllers\Admin\AlbumController::class, 'index']);
    }
}
