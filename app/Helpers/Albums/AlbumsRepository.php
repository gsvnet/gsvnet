<?php

namespace App\Helpers\Albums;

use Illuminate\Support\Facades\Gate;

class AlbumsRepository
{
    /**
     * Get all albums
     */
    public function all()
    {
        if (Gate::allows('photos.show-private')) {
            return Album::latest()->get();
        }

        return Album::latest()->public()->get();
    }

    /**
     * Get paginated albums
     */
    public function paginate(int $amount)
    {
        if (Gate::allows('photos.show-private')) {
            return Album::latest()->paginate($amount);
        }

        return Album::latest()->public()->paginate($amount);
    }

    /**
     * Get paginated albums
     *
     * @TODO this should use eager loading
     */
    public function paginateWithFirstPhoto(int $amount)
    {
        if (Gate::allows('photos.show-private')) {
            return Album::with('photos')->has('photos')->latest()->paginate($amount);
        }

        return Album::with('photos')->has('photos')->latest()->public()->paginate($amount);
    }

    /**
     * Get paginated albums
     *
     * @TODO this should use eager loading
     */
    public function paginatePublicWithFirstPhoto(int $amount)
    {
        return Album::has('photos')
            ->latest()
            ->public()
            ->paginate($amount);
    }

    /**
     * Get first album
     */
    public function first(): Album
    {
        return Album::orderBy('updated_at', 'DESC')->firstOrFail();
    }

    /**
     * Get by slug
     */
    public function byId(int $id): Album
    {
        return Album::findOrFail($id);
    }

    /**
     * Get by slug
     */
    public function bySlug(string $slug): Album
    {
        return Album::where('slug', '=', $slug)->first();
    }

    /**
     * Create album
     */
    public function create(array $input): Album
    {
        $album = new Album();
        $album->name = $input['name'];
        $album->description = $input['description'];
        $album->public = $input['public'];
        $album->slug = $album->generateNewSlug();

        $album->save();

        return $album;
    }

    /**
     * Update album
     */
    public function update(int $id, array $input): Album
    {
        $album = $this->byId($id);

        $album->name = $input['name'];
        $album->description = $input['description'];
        $album->public = $input['public'];
        $album->slug = $album->generateNewSlug();

        $album->save();

        return $album;
    }

    /**
     * Delete album
     *
     * @TODO: delete all photos
     */
    public function delete(int $id): Album
    {
        $album = $this->byId($id);
        $album->delete();

        return $album;
    }
}
