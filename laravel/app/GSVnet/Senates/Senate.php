<?php namespace GSVnet\Senates;

class Senate extends \Eloquent {
    protected $guarded = array();

    public static $rules = array();

    public $presenter = 'GSVnet\Senates\SenatePresenter';

    public function members()
    {
        return $this->belongsToMany('GSVnet\Users\User', 'user_senate')
            ->withPivot('function')->orderBy('function', 'ASC');
    }
}