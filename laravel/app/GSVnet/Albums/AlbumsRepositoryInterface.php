<?php namespace GSVnet\Albums;

interface AlbumsRepositoryInterface
{
     /**
    * Get all albums
    *
    * @return Collection
    */
    public function all();

    /**
     * Get paginated albums
     *
     * @param int $amount
     */
    public function paginate($amount);

    /**
     * Get by slug
     *
     * @param int $id
     * @return Album
     */
    public function byId($id);

    /**
    * Create file
    *
    * @param array $input
    * @return File
    */
    public function create(array $input);

    /**
    * Update file
    *
    * @param int $id
    * @param array $input
    * @return File
    */
    public function update($id, array $input);

    /**
    * Delete file
    *
    * @param int $id
    * @param array $input
    * @return File
    */
    public function delete($id);
}