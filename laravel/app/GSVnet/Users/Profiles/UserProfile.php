<?php namespace GSVnet\Users\Profiles;

use Config;

class UserProfile extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';

    protected $fillable = array(
        'user_id',
        'year_group_id',
        'region',
        'phone',
        'address',
        'zip_code',
        'town',
        'study',
        'birthdate',
        'church',
        'gender',
        'start_date_rug',
        'reunist',
        'parent_address',
        'parent_zip_code',
        'parent_town',
        'parent_phone'
    );

    public function yearGroup()
    {
        return $this->belongsTo('GSVnet\Users\YearGroup');
    }

    public function user()
    {
        return $this->belongsTo('GSVnet\Users\User');
    }

    public function getRegionNameAttribute()
    {
        $regions = Config::get('gsvnet.regions');
        return $regions[$this->region];
    }
}