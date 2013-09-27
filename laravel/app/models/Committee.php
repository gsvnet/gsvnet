<?php namespace Model;

class Committee extends \Eloquent {
	protected $guarded = array();

	public static $rules = array();

    public function users()
    {
        return $this->belongsToMany('Model\User', 'committee_user')
                    ->withPivot('start_date', 'end_date');
    }

    public function activeUsers()
    {
        return $this->belongsToMany('Model\User', 'committee_user')
                    ->where('end_date', null)
                    ->orWhere('end_date', '>=', new \DateTime('now'))
                    ->withPivot('start_date', 'end_date');
    }
}