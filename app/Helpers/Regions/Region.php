<?php

namespace App\Helpers\Regions;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = [];

    public static $rules = [];

    public function members()
    {
        return $this->belongsToMany(\App\Helpers\Users\Profiles\UserProfile::class, 'region_user_profile');
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
