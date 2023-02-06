<?php

namespace App\Helpers\Committees\CommitteeMembership;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class CommitteeMembership extends Model
{
    use PresentableTrait;

    protected $table = 'committee_user';

    protected $guarded = [];

    public static $rules = [];

    public $presenter = 'App\Helpers\Committees\CommitteeMembership\CommitteeMembershipPresenter';

    // Change users to members?
    public function member()
    {
        return $this->belongsTo('App\Helpers\Users\User', 'user_id');
    }

    public function committee()
    {
        return $this->belongsTo('App\Helpers\Committees\Committee');
    }
}
