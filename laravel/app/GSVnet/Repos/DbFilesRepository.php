<?php namespace GSVnet\Repos;

use Model\File;

class DbFilesRepository implements FilesRepositoryInterface
{
    /**
    * Get all albums
    *
    * @return Collection
    */
    public function all()
    {
        return File::all();
    }

    /**
     * Get paginated albums
     *
     * @param int $amount
     */
    public function paginate($amount)
    {
        return File::paginate($amount);
    }

    /**
    *   Get all files belonging to selected labels
    *
    *   @param
    */
    public function paginateWhereLabels($amount, $labels = [])
    {
        $count = count($labels);
        // Just return paginated data when we have no restriction
        //  on the labels
        if ($count == 0)
        {
            return File::paginate($amount);
        }
        // Get the ids of files which belong to all the specified labels
        $file_ids = \DB::table('file_label')
            ->whereIn('label_id', $labels)
            ->groupBy('file_id')
            ->havingRaw('count(*) = ' . $count)
            ->lists('file_id');
        // Return all files with the found ids
        return File::whereIn('id', $file_ids)->paginate($amount);
    }

    /**
     * Get by slug
     *
     * @param int $id
     * @return Album
     */
    public function byId($id)
    {
        return File::findOrFail($id);
    }

    /**
    * Create file
    *
    * @param array $input
    * @return File
    */
    public function create(array $input)
    {
        $file = new File;
        $file->name = $input['name'];
        $file->file_path = $input['file_path'];
        $file->save();

        if (isset($input['labels']))
        {
            $file->labels()->sync($input['labels']);
        }

        return $file;
    }

    /**
    * Update file
    *
    * @param int $id
    * @param array $input
    * @return File
    */
    public function update($id, array $input)
    {
        $file = $this->byId($id);
        $file->update($input);
        // Reset the selected labels
        if (isset($input['labels']))
        {
            $file->labels()->sync($input['labels']);
        }
        else
        {
            $file->labels()->sync(array());
        }

        return $file;
    }

    /**
    * Delete file
    *
    * @param int $id
    * @return File
    */
    public function delete($id)
    {
        $file = $this->byId($id);
        $file->delete();

        return $file;
    }
}