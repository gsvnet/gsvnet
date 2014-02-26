<?php namespace GSVnet\Users;

class YearGroupRepository {

    /**
     * Get by id
     *
     * @param int $id
     * @return Album
     */
    public function byId($id)
    {
        return YearGroup::findOrFail($id);
    }

    /**
     * Check if year group exists
     *
     * @param int $id
     * @return Album
     */
    public function exists($id)
    {
        try
        {
            $this->byId($id);
        }
        catch (Illuminate\Database\Eloquent\ModelNotFoundException $e)
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