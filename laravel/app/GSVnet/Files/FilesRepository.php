<?php namespace GSVnet\Files;

use Permission;

class FilesRepository
{
    /**
    * Get all albums
    *
    * @return Collection
    */
    public function all($published = true)
    {
        return File::published($published)->all();
    }

    /**
     * Get paginated albums
     *
     * @param int $amount
     */
    public function paginate($amount, $published = true)
    {
        return File::published($published)->paginate($amount);
    }

    /**
    *   Get all files belonging to selected labels
    *
    *   @param
    */
    public function paginateWhereLabels($amount, $labels = [], $published = true)
    {
        $count = count($labels);
        // Just return paginated data when we have no restriction
        //  on the labels
        if ($count == 0)
        {
            return File::published($published)->paginate($amount);
        }
        // Get the ids of files which belong to all the specified labels
        $file_ids = \DB::table('file_label')
            ->whereIn('label_id', $labels)
            ->groupBy('file_id')
            ->havingRaw('count(*) = ' . $count)
            ->lists('file_id');
        // Return all files with the found ids
        return File::published($published)->whereIn('id', $file_ids)->paginate($amount);
    }

    /**
     * Get by slug
     *
     * @param int $id
     * @return Album
     */
    public function byId($id)
    {
        $file = File::findOrFail($id);

        if (! $file->published and ! Permission::has('docs.publish'))
        {
            throw new NoPermissionException;
        }

        return $file;
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

        if (Permission::has('docs.publish'))
        {
            $file->published = $input['published'];
        }

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
        $file->fill($input);

        if (Permission::has('docs.publish'))
        {
            $file->published = $input['published'];
        }
        $file->save();

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