<?php namespace GSVnet\Repos;

interface AlbumsRepositoryInterface
{
    /**
    * Get all albums
    *
    * @return Collection
    */
    public function all();

    /**
    * Get recent albums
    *
    * @param int $amount
    * @return Collection
    */
    public function recent($amount);

    /**
     * Get paginated albums
     *
     * @param int $amount
     */
    public function paginate($amount);
    public function paginateWithFirstPhoto($amount);


    /**
    * Get first album
    *
    * @return Album
    */
    public function first();

    /**
     * Get by slug
     *
     * @param int $id
     * @return Album
     */
    public function byId($id);

    /**
     * Get by slug
     *
     * @param string $slug
     * @return Album
     */
    public function bySLug($slug);


    /**
    * Create album
    *
    * @param array $input
    * @return News
    */
    public function create(array $input);

    /**
    * Update album
    *
    * @param int $id
    * @param array $input
    * @return Album
    */
    public function update($id, array $input);

    /**
    * Delete album
    *
    * @param int $id
    * @param array $input
    * @return Album
    */
    public function delete($id);
}