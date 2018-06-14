<?php namespace GSVnet\Regions;

use GSVnet\Users\User;

class RegionsRepository {

    /**
     * Get by id
     *
     * @param int $id
     * @return Region
     */
    public function byId($id)
    {
        return Region::findOrFail($id);
    }

    /**
     * Get by id, returning null if it doesn't exist
     *
     * @param int $id
     * @return Region or null
     */
    public function tryById($id)
    {
        return Region::find($id);
    }


    public function byIds(Array $ids)
    {
        return Region::whereIn('id', $ids)->get();
    }

    /**
     * Check if region exists
     *
     * @param int $id
     * @return Region
     */
    public function exists($id)
    {
        try
        {
            $this->byId($id);
        }
        catch (ModelNotFoundException $e)
        {
            return false;
        }
        return true;
    }

    /**
    * Get all regions
    *
    * @return Collection
    */
    public function all()
    {
        return Region::orderBy(\DB::raw('end_date IS NULL'), 'desc')
                    ->orderBy('end_date', 'desc')
                    ->orderBy('name', 'ASC')
                    ->get();
    }

    /**
    * Get current regions
    *
    * @return Collection
    */

    public function current()
    {
        return Region::current()
                    ->orderBy('name', 'ASC')
                    ->get();
    }

    /**
    * Get former regions
    *
    * @return Collection
    */

    public function former()
    {
        return Region::former()
                    ->orderBy('name', 'ASC')
                    ->get();
    }
}