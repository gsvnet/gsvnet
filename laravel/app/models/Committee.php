<?php namespace Model;

class Committee extends \Eloquent {
	protected $guarded = array();

	public static $rules = array();
    // Change users to members?
    public function members()
    {
        return $this->belongsToMany('Model\User', 'committee_user')
                    ->withPivot('start_date', 'end_date');
    }

    public function activeMembers()
    {
        // Select all active members, i.e. for which the current date is
        //  between the start and enddate
        return $this->belongsToMany('Model\User', 'committee_user')
            ->wherePivot('end_date', '>=', new \DateTime('now'))
            ->wherePivot('start_date', '<=', new \DateTime('now'))
            ->withPivot('start_date', 'end_date');
    }


    public function users()
    {
        return $this->members();
    }

    public function activeUsers()
    {
        return $this->activeMembers();
    }
}