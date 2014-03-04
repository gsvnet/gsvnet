<?php namespace GSVnet\Senates;

class Senate extends \Eloquent {
    protected $guarded = array();

    public static $rules = array();

    public $presenter = 'GSVnet\Senates\SenatePresenter';

    public function members()
    {
        return $this->belongsToMany('GSVnet\Users\User', 'user_senate')
            ->withPivot('function');
    }

    public function activeMembers()
    {
        // Select all active members, i.e. for which the current date is
        //  between the start and enddate
        return $this->belongsToMany('GSVnet\Users\User', 'committee_user')
            ->where('start_date', '<=', new \DateTime('now'))
            ->where('end_date', '>=', new \DateTime('now'))
            ->withPivot('function');
    }
}