<?php namespace Model;

class Committee extends \Eloquent {
	protected $guarded = array();

	public static $rules = array();

    public function users()
    {
        return $this->belongsToMany('Model\User', 'committee_user')
                    ->withPivot('start_date', 'end_date');
    }
}