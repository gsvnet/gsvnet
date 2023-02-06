<?php

namespace App\Helpers\Committees;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Committee extends Model
{
    use PresentableTrait;

    protected $guarded = [];

    public static $rules = [];

    public $presenter = \App\Helpers\Committees\CommitteePresenter::class;

    public function scopePublic($query)
    {
        return $query->wherePublic(true);
    }

    public function getPublicAttribute($value)
    {
        return $value == 1 ? 1 : null;
    }

    // Change users to members?
    public function members()
    {
        return $this->belongsToMany(\App\Helpers\Users\User::class, 'committee_user')
            ->withPivot('id', 'start_date', 'end_date');
    }

    public function activeMembers()
    {
        // Select all active members, i.e. for which the current date is
        //  between the start and enddate
        return $this->belongsToMany(\App\Helpers\Users\User::class, 'committee_user')
            ->where('committee_user.start_date', '<=', new \DateTime('now'))
            ->where(function ($q) {
                return $q->where('committee_user.end_date', '>=', new \DateTime('now'))
                    ->orWhereNull('committee_user.end_date');
            })
            ->withPivot('start_date', 'end_date');
    }

    public function users()
    {
        return $this->members();
    }

    public function activeUsers()
    {
        return $this->activeMembers();
    }
}
