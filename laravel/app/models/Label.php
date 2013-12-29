<?php namespace Model;

class Label extends \Eloquent {
	protected $guarded = array();

	public static $rules = array();

    public function files()
    {
        return $this->belongsToMany('Model\File', 'file_label');
        $this->hasMany('Model\Files');
    }
}
