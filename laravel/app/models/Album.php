<?php namespace Model;

use URL;

class Album extends \Eloquent {

	protected $fillable = array('name', 'description');

	public static $rules = array(
        'name'        => 'required',
        'description' => 'required'
    );

    public function scopePublic($query)
    {
        $query->wherePublic(true);
    }

    public function scopeLatest($query)
    {
        $query->orderBy('updated_at', 'DESC');
    }

    public function photos()
    {
        return $this->hasMany('Model\Photo');
    }

    public function getSmallImageURLAttribute()
    {
        $photo = $this->photos->first();
        return $photo->small_image_url;
    }

    public function getWideImageURLAttribute()
    {
        $photo = $this->photos->first();
        return $photo->wide_image_url;
    }

    public function getShowURLAttribute()
    {
        return URL::action('PhotoController@showPhotos', $this->slug);
    }

    // Return the path to the original image
    public function getImageURLAttribute()
    {
        $photo = $this->photos->first();
        return URL::action('PhotoController@showPhotos', $this->slug);
    }

    public function getUpdatedAtAttribute($updatedAt)
    {
        $date = new \Carbon\Carbon($updatedAt);

        return $date->diffForHumans();
    }

    public function getPublicAttribute($value)
    {
        return $value == 1 ? true : null;
    }
}