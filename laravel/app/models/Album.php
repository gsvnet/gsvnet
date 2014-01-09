<?php namespace Model;

use URL;

class Album extends \Eloquent {

	protected $fillable = array('name', 'description');

	public static $rules = array(
        'name'        => 'required',
        'description' => 'required'
    );

    public function photos()
    {
        return $this->hasMany('Model\Photo');
    }

    public function getSmallImageAttribute()
    {
        $photo = $this->photos->first();
        return $photo->small_image;
    }

    public function getWideImageAttribute()
    {
        $photo = $this->photos->first();
        return $photo->wide_image;
    }

    public function getShowURLAttribute()
    {
        return URL::action('PhotoController@showPhotos', $this->slug);
    }

    // Return the path to the original image
    public function getImageURLAttribute()
    {
        return URL::action('PhotoController@showPhotos', $this->slug);
    }

    // Return the path to the original image
    public function getWideImageURLAttribute()
    {
        $photo = $this->photos->first();
        return URL::action('PhotoController@showPhotoWide', $photo->id);
    }

    // Return the path to the original image
    public function getSmallImageURLAttribute()
    {
        $photo = $this->photos->first();
        return URL::action('PhotoController@showPhotoSmall', $photo->id);
    }

    public function getUpdatedAtAttribute($updatedAt)
    {
        $date = new \Carbon\Carbon($updatedAt);

        return $date->diffForHumans();
    }
}