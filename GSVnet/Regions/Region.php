<?php namespace GSVnet\Regions;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

    protected $guarded = array();

    public static $rules = array();

    public function members()
    {
        return $this->belongsToMany('GSVnet\Users\Profiles\UserProfile', 'region_user_profile');
    }

    public function scopeCurrent($query)
    {
        return $query->whereNull('end_date');
    }

    public function scopeFormer($query)
    {
        return $query->whereNotNull('end_date');
    }
}