<?php namespace GSVnet\Committees\CommitteeMembership;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Model;

class CommitteeMembership extends Model {
    
    use PresentableTrait;

    protected $table = 'committee_user';

    protected $guarded = array();

    public static $rules = array();

    public $presenter = 'GSVnet\Committees\CommitteeMembership\CommitteeMembershipPresenter';

    // Change users to members?
    public function member()
    {
        return $this->belongsTo('GSVnet\Users\User', 'user_id');
    }

    public function committee()
    {
        return $this->belongsTo('GSVnet\Committees\Committee');
    }
}