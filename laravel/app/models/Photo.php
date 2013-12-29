<?php namespace Model;

use File;
use Image;

class Photo extends \Eloquent {
    private static $dimensions = [
        'small' => [308, 308],
        'wide' => [634, 308]
    ];

	protected $fillable = array('name', 'description');

    public static $rules = array(
        'album_id'    => 'required|integer',
    );

    public function album()
    {
        return $this->belongsTo('Model\Album');
    }

    // Check if /uploads/photos/{src-path}-small exists else create it, save it and return it
    public function smallImage()
    {
        return $this->small_image;
    }

    public function getSmallIMageAttribute()
    {
        return $this->grabImage('small');
    }

    public function getWideImageAttribute()
    {
        return $this->grabImage('wide');
    }

    public function wideImage()
    {
        return $this->wide_image;
    }

    private function grabImage($dimension)
    {
        $orignalImagePath = public_path() . $this->src_path;
        $newPath = '';

        if (File::exists($orignalImagePath))
        {
            $ext = File::extension(public_path() . $this->src_path);
            $newPath = str_replace('.' . $ext, '', $this->src_path) . '-' . $dimension . '.' . $ext;
        }
        else
        {
            // We can't find the orignal image, thus we have to return the original image locatoin
            return $this->src_path;
        }
        if (! File::exists(public_path() . $newPath))
        {
            $img = Image::make($orignalImagePath);
            // Resize the image while maintaining correct aspect ratio
            $img->grab(self::$dimensions[$dimension][0], self::$dimensions[$dimension][1]);
            // finally we save the image as a new image
            $img->save(public_path() . $newPath);
        }
        return $newPath;
    }

    // Show original image
    public function getShowURLAttribute()
    {
        return $this->src_path;
    }
}