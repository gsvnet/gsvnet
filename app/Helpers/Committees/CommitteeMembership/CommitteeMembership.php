<?php namespace GSV\Helpers\Committees\CommitteeMembership;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Model;

class CommitteeMembership extends Model {
    
    use PresentableTrait;

    protected $table = 'committee_user';

    protected $guarded = array();

    public static $rules = array();

    public $presenter = 'GSV\Helpers\Committees\CommitteeMembership\CommitteeMembershipPresenter';

    // Change users to members?
    public function member()
    {
        return $this->belongsTo('GSV\Helpers\Users\User', 'user_id');
    }

    public function committee()
    {
        return $this->belongsTo('GSV\Helpers\Committees\Committee');
    }
}