<?php

class Committee extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

    public function users()
    {
        return $this->belongsToMany('Users', 'committee_user')
                    ->withPivot('start_time', 'end_time');
    }
}