<?php

namespace App\Helpers\Files;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class File extends Model
{
    use PresentableTrait;

    protected $fillable = ['name', 'file_path', 'published'];

    protected $presenter = FilePresenter::class;
    public static $rules = [
        'name' => 'required',
    ];

    public function scopePublished($query, $published = true)
    {
        if (! $published) {
            return $query;
        }

        return $query->wherePublished($published);
    }

    public function scopeWithLabels($query, array $labels = [])
    {
        $count = count($labels);
        // Return original query when we have no restriction on the labels
        if ($count == 0) {
            return $query;
        }

        // Get the ids of files which belong to all the specified labels
        $file_ids = \DB::table('file_label')
            ->whereIn('label_id', $labels)
            ->groupBy('file_id')
            ->havingRaw('count(*) = '.$count)
            ->pluck('file_id');

        if (empty($file_ids)) {
            // null returnen
            return $query->where(\DB::raw('false'));
        }

        // Return all files with the found ids
        return $query->whereIn('id', $file_ids);
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereRaw('MATCH(name) AGAINST(? IN BOOLEAN MODE)', [$search]);
    }

    public function labels()
    {
        return $this->belongsToMany(\App\Helpers\Files\Labels\Label::class, 'file_label');
    }

    public function getSizeAttribute()
    {
        /** @var $fileHandler FileHandler */
        $fileHandler = app(FileHandler::class);

        return $this->readable_size($fileHandler->fileSize($this->file_path));
    }

    public function getTypeAttribute()
    {
        /** @var $fileHandler FileHandler */
        $fileHandler = app(FileHandler::class);

        return '.'.$fileHandler->extension($this->file_path);
    }

    public function fileLocation()
    {
        return storage_path().$this->file_path;
    }

    /**
     * Displays file sizes in a human readable format.
     * --------------------------------------------------
     * Note: Because PHP's integer type is signed and
     * many platforms use 32bit integers, some filesystem
     * functions may return unexpected results for files
     * which are larger than 2GB.
     *
     * http://www.php.net/manual/en/function.filesize.php
     */
    private function readable_size($size)
    {
        $tmp = $size;
        if ($tmp >= 0 && $tmp < 1024) {
            $file = $tmp.' bytes';
        } elseif ($tmp >= 1024 && $tmp < 1048576) { // less than 1 MB
            $tmp = $tmp / 1024;
            $file = round($tmp).' KB';
        } elseif ($tmp >= 1048576 && $tmp < 10485760) { // more than 1 MB, but less than 10
            $tmp = $tmp / 1048576;
            $file = round($tmp, 1).' MB';
        } else { // less than 1 GB
            $tmp = $tmp / (1024 * 1024 * 1024);
            $file = round($tmp, 1).' GB';
            // } else {
        //     $file = 'groter dan je moeder';
        }

        return $file;
    }
}
