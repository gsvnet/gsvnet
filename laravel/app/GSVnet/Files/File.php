<?php namespace GSVnet\Files;

use GSVnet\Files\FileHandler;
use Laracasts\Presenter\PresentableTrait;

class File extends \Eloquent {
    use PresentableTrait;

    protected $fillable = array('name', 'file_path', 'published');

    protected $presenter = 'GSVnet\Files\FilePresenter';

    public static $rules = array(
        'name' => 'required'
    );

    protected $fileHandler;

    public function __construct()
    {
        $this->fileHandler = new FileHandler;
    }

    public function scopePublished($query, $published = true)
    {
        if (! $published) { return $query; }
        return $query->wherePublished($published);
    }

    public function scopeWithLabels($query, array $labels = [])
    {
        $count = count($labels);
        // Return original query when we have no restriction on the labels
        if ($count == 0) { return $query; }

        // Get the ids of files which belong to all the specified labels
        $file_ids = \DB::table('file_label')
            ->whereIn('label_id', $labels)
            ->groupBy('file_id')
            ->havingRaw('count(*) = ' . $count)
            ->lists('file_id');

        if (empty($file_ids))
        {
            // null returnen
            return $query->where(\DB::raw('false'));
        }

        // Return all files with the found ids
        return $query->whereIn('id', $file_ids);
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)", [$search]);
    }

    public function labels()
    {
        return $this->belongsToMany('GSVnet\Files\Labels\Label', 'file_label');
    }

    public function getSizeAttribute()
    {
        return $this->readable_size($this->fileHandler->fileSize($this->file_path));
    }

    public function getTypeAttribute()
    {
        return '.' . $this->fileHandler->extension($this->file_path);
    }

    public function fileLocation()
    {
        return storage_path() . $this->file_path;
    }

    public function getUpdatedAtAttribute($updatedAt)
    {
        $date = new \Carbon\Carbon($updatedAt);

        return $date->diffForHumans();
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
    private function readable_size($size) {
        $tmp = $size;
        $file = 0;
        if ($tmp >= 0 && $tmp < 1024) {
            $file = $tmp . " bytes";
        } elseif ($tmp >=1024 && $tmp < 1048576) { // less than 1 MB
                $tmp = $tmp / 1024;
                $file = round($tmp) . " KB";
        } elseif ($tmp >=1048576 && $tmp < 10485760) { // more than 1 MB, but less than 10
                $tmp = $tmp / 1048576;
                $file = round($tmp, 1) . " MB";
        } else { // less than 1 GB
                $tmp = $tmp / (1024 * 1024 * 1024);
                $file = round($tmp, 1) . " GB";
        // } else {
        //     $file = 'groter dan je moeder';
        }
        return $file;
    }
}
