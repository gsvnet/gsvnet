<?php namespace Model;

class Photo extends \Eloquent {
	protected $fillable = array('name', 'description');

    public static $rules = array(
        'name'        => 'required',
        'album_id'    => 'required|integer',
    );

    public function album()
    {
        return $this->belongsTo('Model\Album');
    }

    // Check if /uploads/photos/{src-path}-small exists else create it, save it and return it
    public function smallImage()
    {
        return $this->src_path;
        return 'http://lorempixel.com/306/306/abstract?' . $this->id;
    }

    public function wideImage()
    {
        return $this->src_path;
        return 'http://lorempixel.com/634/306/abstract?' . $this->id;
    }

    // Show original image
    public function getShowURLAttribute()
    {
        return 'http://lorempixel.com/1600/1200/abstract?' . $this->id;
    }
}