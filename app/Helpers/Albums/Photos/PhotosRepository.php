<?php

namespace App\Helpers\Albums\Photos;

class PhotosRepository
{
    public function getInstance()
    {
        return new Photo;
    }

    /**
     * Get by id
     */
    public function byId(int $id): Photo
    {
        return Photo::findOrFail($id);
    }

    /**
     * Get by album id and paginate photos
     */
    public function byAlbumIdAndPaginate(int $id, int $amount): Collection
    {
        return Photo::whereAlbumId($id)->paginate($amount);
    }

    /**
     * Create photo
     */
    public function create(array $input): Photo
    {
        $photo = $this->getInstance();
        $photo->name = $input['name'];
        $photo->album_id = $input['album_id'];
        $photo->src_path = $input['src_path'];
        $photo->save();

        return $photo;
    }

    /**
     * Update photo
     */
    public function update(int $id, array $input): Photo
    {
        $photo = $this->byId($id);
        $photo->update($input);

        return $photo;
    }

    /**
     * Delete photo
     */
    public function delete(int $id): Photo
    {
        $photo = $this->byId($id);
        $photo->delete();

        return $photo;
    }
}
