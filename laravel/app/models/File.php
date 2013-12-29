<?php namespace Model;

class File extends \Eloquent {
	protected $guarded = array();

	public static $rules = array();

    public function labels()
    {
        return $this->hasMany('Model\Label')
    }
}
