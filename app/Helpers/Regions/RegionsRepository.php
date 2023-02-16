<?php

namespace App\Helpers\Regions;

class RegionsRepository
{
    /**
     * Get by id
     */
    public function byId(int $id): Region
    {
        return Region::findOrFail($id);
    }

    /**
     * Get by id, returning null if it doesn't exist
     *
     * @return Region or null
     */
    public function tryById(int $id): Region
    {
        return Region::find($id);
    }

    public function byIds(array $ids)
    {
        return Region::whereIn('id', $ids)->get();
    }

    /**
     * Check if region exists
     */
    public function exists(int $id): Region
    {
        try {
            $this->byId($id);
        } catch (ModelNotFoundException $e) {
            return false;
        }

        return true;
    }

    /**
     * Get all regions
     */
    public function all(): Collection
    {
        return Region::orderBy(\DB::raw('end_date IS NULL'), 'desc')
                    ->orderBy('end_date', 'desc')
                    ->orderBy('name', 'ASC')
                    ->get();
    }

    /**
     * Get current regions
     */
    public function current(): Collection
    {
        return Region::current()
                    ->orderBy('end_date', 'DESC')
                    ->orderBy('name', 'ASC')
                    ->get();
    }

    /**
     * Get former regions
     */
    public function former(): Collection
    {
        return Region::former()
            ->orderBy('end_date', 'DESC')
            ->orderBy('name', 'ASC')
            ->get();
    }
}
