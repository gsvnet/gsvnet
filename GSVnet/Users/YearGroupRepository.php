<?php namespace GSVnet\Users;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class YearGroupRepository {

    /**
     * Get by id
     *
     * @param int $id
     * @return YearGroup
     */
    public function byId($id)
    {
        return YearGroup::findOrFail($id);
    }

    /**
     * Check if year group exists
     *
     * @param int $id
     * @return YearGroup
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
    *   Getall year groups in descending order
    */
    public function all()
    {
        return YearGroup::orderBy('year', 'DESC')->get();
    }
}