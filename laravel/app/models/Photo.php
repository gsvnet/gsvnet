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
        return 'http://lorempixel.com/306/306?' . $this->id;
    }

    public function wideImage()
    {
        return 'http://lorempixel.com/634/306?' . $this->id;
    }
}