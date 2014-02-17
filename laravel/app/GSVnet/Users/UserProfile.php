<?php namespace GSVnet\Users;

class UserProfile extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';

    public function yearGroup()
    {
        return $this->belongsTo('GSVnet\Users\YearGroup');
    }

    public function user()
    {
        return $this->belongsTo('GSVnet\Users\User');
    }
}