<?php namespace Model;

use URL;
use GSVnet\Albums\Photos\ImageHandler;

class Photo extends \Eloquent {
    // Define the dimensions of small and wide photos

	protected $fillable = array('name', 'src_path');
    protected $imageHandler;

    public static $rules = array(
        'album_id'    => 'required|integer',
    );

    public function __construct(ImageHandler $imageHandler)
    {
        $this->imageHandler = $imageHandlerw;
    }

    // The photo's album
    public function album()
    {
        return $this->belongsTo('Model\Album');
    }


    public function getImageAttribute()
    {
        return $this->imageHandler->get($this->src_path);
    }
    // Check if /uploads/photos/{src-path}-small exists else create it, save it and return it
    public function getSmallIMageAttribute()
    {
        return $this->imageHandler->get($this->src_path, 'small');
    }

    public function getWideImageAttribute()
    {
        return $this->imageHandler->get($this->src_path, 'wide');
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
}