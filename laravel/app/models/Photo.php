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

    // The photo's album
    public function album()
    {
        return $this->belongsTo('Model\Album');
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