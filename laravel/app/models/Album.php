<?php namespace Model;

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

    public function smallImage()
    {
        return 'http://lorempixel.com/306/306?' . $this->id;
    }

    public function wideImage()
    {
        return 'http://lorempixel.com/634/306?' . $this->id;
    }

    public function getShowURLAttribute()
    {
        return \URL::route('show_media', $this->slug);
    }
}