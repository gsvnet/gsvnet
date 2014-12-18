<?php namespace GSVnet\Users\Profiles;

use Config;
use Gravatar;
use Laracasts\Presenter\PresentableTrait;

class UserProfile extends \Eloquent {

    use PresentableTrait;

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
        'initials',
        'phone',
        'address',
        'zip_code',
        'town',
        'study',
        'birthdate',
        'church',
        'gender',
        'student_number',
        'reunist',
        'parent_address',
        'parent_zip_code',
        'parent_town',
        'parent_phone',
        'photo_path',
    );

    public $presenter = 'GSVnet\Users\Profiles\ProfilePresenter';

    public function scopeSearchNameAndPhone($query, $search)
    {
        return $query->whereRaw("MATCH(users.firstname, users.middlename, users.lastname) AGAINST(? IN BOOLEAN MODE)", [$search]);
    }

    public function yearGroup()
    {
        return $this->belongsTo('GSVnet\Users\YearGroup');
    }

    public function user()
    {
        return $this->belongsTo('GSVnet\Users\User');
    }
}