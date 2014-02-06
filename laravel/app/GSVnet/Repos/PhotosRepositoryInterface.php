<?php namespace GSVnet\Repos;

interface PhotosRepositoryInterface
{
    /**
     * Get by id
     *
     * @param int $id
     * @return Photo
     */
    public function byId($id);

    /**
     * Get by album id and paginate photos
     *
     * @param int $id
     * @param int $amount
     * @return Collection
     */
    public function byAlbumIdAndPaginate($id, $amount);

    /**
    * Create photo
    *
    * @param array $input
    * @return Photo
    */
    public function create(array $input);

    /**
    * Update photo
    *
    * @param int $id
    * @param array $input
    * @return Photo
    */
    public function update($id, array $input);

    /**
    * Delete photo
    *
    * @param int $id
    * @param array $input
    * @return Photo
    */
    public function delete($id);
}