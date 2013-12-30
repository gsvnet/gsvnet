<?php namespace Model;

class File extends \Eloquent {
	protected $guarded = array();

	public static $rules = array(
        'name' => 'required'
    );

    public function labels()
    {
        return $this->belongsToMany('Model\Label', 'file_label');
    }
}
