<?php namespace App\Helpers\Committees;

use Illuminate\Database\Eloquent\Model;

class CommitteeUser extends Model {

    protected $table    = 'committee_user';

    protected $fillable = ['start_date', 'end_date'];

    public function user()
    {
        return $this->belongsTo('App\Helpers\Users\User');
    }

    public function committee()
    {
        return $this->belongsTo('App\Helpers\Committees\Committee');
    }
}