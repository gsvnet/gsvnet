<?php namespace Model;

class Photo extends \Eloquent {
	protected $guarded = array();

	public static $rules = array();

    public function album()
    {
        return $this->belongsTo('Album');
    }

    public function smallImage()
    {
        return 'http://lorempixel.com/306/306/abstract?' . $this->id;
    }

    public function wideImage()
    {
        return 'http://lorempixel.com/634/306/abstract?' . $this->id;
    }

    // Show original image
    public function getShowURLAttribute()
    {
        return 'http://lorempixel.com/1600/1200/abstract?' . $this->id;
    }
}