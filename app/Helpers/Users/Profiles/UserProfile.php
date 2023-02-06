<?php namespace GSV\Helpers\Users\Profiles;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserProfile extends Model {

    use PresentableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'user_id',
        'year_group_id',
        'initials',
        'phone',
        'address',
        'zip_code',
        'town',
        'study',
        'country',
        'birthdate',
        'gender',
        'student_number',
        'reunist',
        'parent_address',
        'parent_zip_code',
        'parent_town',
        'parent_phone',
        'parent_email',
        'photo_path',
        'inauguration_date',
        'resignation_date',
        'company',
        'profession',
        'business_url',
        'alive',
        'receive_newspaper'
    ];
    
    public $presenter = 'GSV\Helpers\Users\Profiles\ProfilePresenter';

    public function scopeSearchNameAndPhone($query, $words)
    {
        foreach ($words as $key) {
            $query = $query->where(function($q) use ($key) {
                $q->orwhere('firstname', 'like', $key . '%')
                ->orwhere('middlename', 'like', $key . '%')
                ->orwhere('lastname', 'like', $key . '%');
                });
        }

        return $query;
    }

    public function inmates() 
    {
        return $this->whereRaw("REPLACE(`address`, ' ' ,'') LIKE ?", [str_replace(' ', '', $this->address)])
        ->where('user_id', '!=', $this->user_id)
        ->whereHas('user', function($q){
            $q->where('type', 2);
        })
        ->get();
    }
    
    public function yearGroup()
    {
        return $this->belongsTo('GSV\Helpers\Users\YearGroup');
    }

    public function user()
    {
        return $this->belongsTo('GSV\Helpers\Users\User');
    }

    public function regions()
    {
        return $this->belongsToMany('GSV\Helpers\Regions\Region', 'region_user_profile')
                ->orderBy(\DB::raw('end_date IS NULL'), 'desc')
                ->orderBy('end_date', 'desc')
                ->orderBy('name', 'asc');
    }

    public function getCurrentRegionAttribute()
    {
        $region = $this->regions->first();

        if($region && $region->end_date) {
            $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $region->end_date);
            
            if($end_date->isPast()) {
                $region = null;
            }
        }
        return !$region ? null : $region;
    }

    public function getFormerRegionsAttribute()
    {
        return $this->regions->filter(function ($region, $i){
            if($region->end_date) {
                $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $region->end_date);
                return $end_date->isPast();
            }
            return false;
        });
    }
}