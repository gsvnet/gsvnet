<?php

namespace App\Helpers\Files;

use App\Helpers\Permissions\NoPermissionException;
use Illuminate\Support\Facades\Gate;

/**
 * Class FilesRepository
 */
class FilesRepository
{
    /**
     * Get all albums
     */
    public function all($published = true): Collection
    {
        return File::published($published)->all();
    }

    /**
     * Get paginated albums
     */
    public function paginate(int $amount, $published = true)
    {
        return File::published($published)->orderBy('updated_at', 'desc')->paginate($amount);
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
        if ($count == 0) {
            return File::published($published)->orderBy('updated_at', 'desc')->paginate($amount);
        }
        // Get the ids of files which belong to all the specified labels
        $file_ids = \DB::table('file_label')
            ->whereIn('label_id', $labels)
            ->groupBy('file_id')
            ->havingRaw('count(*) = '.$count)
            ->pluck('file_id');
        // Return all files with the found ids
        return File::published($published)->whereIn('id', $file_ids)->orderBy('updated_at', 'desc')->paginate($amount);
    }

    public function getPublishedAndSearchWithLabelsAndPaginate($search, $labels, $amount = 5)
    {
        $query = File::published();

        if (! empty($search)) {
            $query = $query->search('*'.$search.'*');
        }

        if (! empty($labels)) {
            $query = $query->withLabels($labels);
        }

        return $query->orderBy('updated_at', 'desc')->paginate($amount);
    }

    /**
     * Get by slug
     *
     *
     * @throws NoPermissionException
     */
    public function byId(int $id)
    {
        $file = File::findOrFail($id);

        if (! $file->published and Gate::denies('docs.publish')) {
            throw new NoPermissionException;
        }

        return $file;
    }

    /**
     * Create file
     */
    public function create(array $input): File
    {
        $file = new File;
        $file->name = $input['name'];
        $file->file_path = $input['file_path'];

        if (Gate::allows('docs.publish')) {
            $file->published = $input['published'];
        }

        $file->save();

        if (isset($input['labels'])) {
            $file->labels()->sync($input['labels']);
        }

        return $file;
    }

    /**
     * Update file
     */
    public function update(int $id, array $input): File
    {
        $file = $this->byId($id);
        $file->fill($input);

        if (Gate::allows('docs.publish')) {
            $file->published = $input['published'];
        }

        $file->save();

        // Reset the selected labels
        if (isset($input['labels'])) {
            $file->labels()->sync($input['labels']);
        } else {
            $file->labels()->sync([]);
        }

        return $file;
    }

    /**
     * Delete file
     */
    public function delete(int $id): File
    {
        $file = $this->byId($id);
        $file->delete();

        return $file;
    }
}
