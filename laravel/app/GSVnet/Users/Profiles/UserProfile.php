<?php namespace GSVnet\Users\Profiles;

use Config;
use Gravatar;

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

    // Blah dit is niet zo mooi, maar voorlopig werkt dit wel
    public function scopeSearch($query, $search)
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

    public function getRegionNameAttribute()
    {
        $regions = Config::get('gsvnet.regions');
        return $regions[$this->region];
    }

    public function getPhotoAttribute()
    {
        // Should return url
        // or img html with url generated
        if ($this->photo_path != '')
        {
            $url = \URL::action('MemberController@showPhoto', $this->id);
            return '<img src="' . $url . '" width="120" height="120" alt="Profielfoto">';
        }
        return Gravatar::image($this->user->email, 'Profielfoto', array('width' => 120, 'height' => 120));
    }
}