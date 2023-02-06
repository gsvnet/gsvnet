<?php namespace GSV\Helpers\Albums\Photos;

class PhotosRepository
{
    public function getInstance()
    {
        return new Photo;
    }

    /**
     * Get by id
     *
     * @param int $id
     * @return Photo
     */
    public function byId($id)
    {
        return Photo::findOrFail($id);
    }

    /**
     * Get by album id and paginate photos
     *
     * @param int $id
     * @param int $amount
     * @return Collection
     */
    public function byAlbumIdAndPaginate($id, $amount)
    {
        return Photo::whereAlbumId($id)->paginate($amount);
    }

    /**
    * Create photo
    *
    * @param array $input
    * @return Photo
    */
    public function create(array $input)
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
    *
    * @param int $id
    * @param array $input
    * @return Photo
    */
    public function update($id, array $input)
    {
        $photo = $this->byId($id);
        $photo->update($input);

        return $photo;
    }

    /**
    * Delete photo
    *
    * @param int $id
    * @return Photo
    */
    public function delete($id)
    {
        $photo = $this->byId($id);
        $photo->delete();

        return $photo;
    }
}