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
        return \URL::route('show_media', $this->slug);
    }

    public function getUpdatedAtAttribute($updatedAt)
    {
        $date = new \Carbon\Carbon($updatedAt);

        return $date->diffForHumans(\Carbon\Carbon::now());
    }
}