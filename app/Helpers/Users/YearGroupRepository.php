<?php

namespace App\Helpers\Users;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class YearGroupRepository
{
    /**
     * Get by id
     */
    public function byId(int $id): YearGroup
    {
        return YearGroup::findOrFail($id);
    }

    /**
     * Check if year group exists
     */
    public function exists(int $id): YearGroup
    {
        try {
            $this->byId($id);
        } catch (ModelNotFoundException $e) {
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
