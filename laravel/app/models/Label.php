<?php namespace Model;

class Label extends \Eloquent {
	protected $guarded = array();

	public static $rules = array();

    public function files()
    {
        $this->hasMany('Model\Files');
    }
}
