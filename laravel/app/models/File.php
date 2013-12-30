<?php namespace Model;

class File extends \Eloquent {
	protected $guarded = array();

	public static $rules = array(
        'name' => 'required'
    );

    public function labels()
    {
        return $this->belongsToMany('Model\Label', 'file_label');
    }

    public function getSizeAttribute()
    {
        return $this->readable_size($this->fileLocation());
    }

    public function getTypeAttribute()
    {
        return '.big';
    }

    public function fileLocation()
    {
        return public_path() . $this->file_path;
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
    private function readable_size($path) {
        $tmp = filesize($path);
        if ($tmp >= 0 && $tmp < 1024) {
            $file = $tmp . " bytes";
        } elseif ($tmp >=1024 && $tmp < 1048576) { // less than 1 MB
                $tmp = $tmp / 1024;
                $file = round($tmp) . " KB";
        } elseif ($tmp >=1048576 && $tmp < 10485760) { // more than 1 MB, but less than 10
                $tmp = $tmp / 1048576;
                $file = round($tmp, 1) . " MB";
        } elseif ($tmp < 1073741824) { // less than 1 GB
                $tmp = $tmp / 1073741824;
                $file = round($tmp) . " GB";
        } else {
            $file = 'groter dan je moeder';
        }
        return $file;
    }
}
