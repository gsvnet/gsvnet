<?php namespace GSVnet\Albums;

use Model\Album, Str;
use Permission;

class AlbumsRepository
{
    /**
    * Get all albums
    *
    * @return Collection
    */
    public function all()
    {
        if (Permission::has('photo.show'))
            return Album::recent()->get();
        return Album::recent()->public()->get();
    }

    /**
     * Get paginated albums
     *
     * @param int $amount
     */
    public function paginate($amount)
    {
        if (Permission::has('photo.show'))
            return Album::recent()->paginate($amount);
        return Album::recent()->public()->paginate($amount);
    }

    /**
     * Get paginated albums
     * @TODO this should use eager loading
     * @param int $amount
     */
    public function paginateWithFirstPhoto($amount)
    {
        if (Permission::has('photo.show'))
            return Album::with('photos')->latest()->paginate($amount);
        return Album::with('photos')->latest()->public()->paginate($amount);
        return Album::has('photos')
            ->latest()
            ->paginate($amount);
    }

    /**
     * Get paginated albums
     * @TODO this should use eager loading
     * @param int $amount
     */
    public function paginatePublicWithFirstPhoto($amount)
    {
        return Album::has('photos')
            ->latest()
            ->public()
            ->paginate($amount);
    }

    /**
    * Get first album
    *
    * @return Album
    */
    public function first()
    {
        return Album::orderBy('updated_at', 'DESC')->firstOrFail();
    }

    /**
     * Get by slug
     *
     * @param int $id
     * @return Album
     */
    public function byId($id)
    {
        return Album::findOrFail($id);
    }

    /**
     * Get by slug
     *
     * @param string $slug
     * @return Album
     */
    public function bySLug($slug)
    {
        return Album::whereSlug($slug)->firstOrFail();
    }



    /**
    * Create album
    *
    * @param array $input
    * @return Album
    */
    public function create(array $input)
    {
        $album              = new Album();
        $album->name        = $input['name'];
        $album->description = $input['description'];
        $album->public      = $input['public'];
        $album->slug        = $this->createSlug($album->name);

        $album->save();

        return $album;
    }

    /**
    * Update album
    *
    * @param int $id
    * @param array $input
    * @return Album
    */
    public function update($id, array $input)
    {
        $album              = $this->byId($id);

        $album->name        = $input['name'];
        $album->description = $input['description'];
        $album->public       = $input['public'];
        $album->slug        = $this->createSlug($album->name);

        $album->save();

        return $album;
    }

    /**
    * Delete album
    *
    * @param int $id
    * @param array $input
    * @return Album
    * @TODO: delete all photos
    */
    public function delete($id)
    {
        $album = $this->byId($id);
        $album->delete();

        // App::make('PhotoManager')->deleteAlbumPhotos($id)

        return $album;
    }

    /**
    * Create slug from name
    * Add an integer if the name's slug is nog unique
    *
    * @param string $name
    * @return string $slug
    */
    private function createSlug($name)
    {
        $slug = Str::slug($name);
        $count = Album::count() + 1;

        return $count . '-' . $slug;
    }
}