<?php namespace Model;

use File;
use Image;
use GSVnet\Services\PhotoHandler;
use URL;

class Photo extends \Eloquent {
    // Define the dimensions of small and wide photos

	protected $fillable = array('name');
    protected $photoHandler;

    public static $rules = array(
        'album_id'    => 'required|integer',
    );

    public function __construct()
    {
        $this->photoHandler = new PhotoHandler;
    }

    // The photo's album
    public function album()
    {
        return $this->belongsTo('Model\Album');
    }

    // Check if /uploads/photos/{src-path}-small exists else create it, save it and return it
    public function getSmallIMageAttribute()
    {
        return $this->photoHandler->get($this, 'small');
        return $this->grabImage('small');
    }

    public function getWideImageAttribute()
    {
        return $this->photoHandler->get($this, 'wide');
        return $this->grabImage('wide');
    }

    public function getImageAttribute()
    {
        return $this->photoHandler->get($this);
    }

    /**
    * Either create or return the resized image of the original image
    * @param string $dimension either small or wide
    */
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

    // Return the path to the original image
    public function getImageURLAttribute()
    {
        return URL::action('PhotoController@showPhoto', $this->id);
    }

    // Return the path to the original image
    public function getWideImageURLAttribute()
    {
        return URL::action('PhotoController@showPhotoWide', $this->id);
    }

    // Return the path to the original image
    public function getSmallImageURLAttribute()
    {
        return URL::action('PhotoController@showPhotoSmall', $this->id);
    }

    public function restrictImageSize()
    {
        $img = Image::make(public_path() . $this->src_path);

        if ($img->width > Self::$dimensions['max'][0] or $img->height > Self::$dimensions['max'][1])
        {
            // Resize the image while maintaining correct aspect ratio
            $img->grab(Self::$dimensions['max'][0], Self::$dimensions['max'][1]);
            // finally we save the image as a new image
            $img->save(public_path() . $this->src_path);
        }
    }
}