<?php namespace GSVnet\Users;

class YearGroup extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'year_groups';
    
    public $presenter = 'GSVnet\Users\YearGroupPresenter';

    public function userProfiles() {
        return $this->hasMany('GSVnet\Users\Profiles\UserProfile');
    }

}