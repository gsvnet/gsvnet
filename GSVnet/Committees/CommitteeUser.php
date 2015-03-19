<?php namespace GSVnet\Committees;

use Illuminate\Database\Eloquent\Model;

class CommitteeUser extends Model {

    protected $table    = 'committee_user';

    protected $fillable = ['start_date', 'end_date'];

    public function user()
    {
        return $this->belongsTo('GSVnet\Users\User');
    }

    public function committee()
    {
        return $this->belongsTo('GSVnet\Committees\Committee');
    }
}