<?php namespace GSVnet\Events;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model {

    protected $table    = 'event_user';

    public function event()
    {
        return $this->belongsTo('GSVnet\Events\Event');
    }

    public function user()
    {
        return $this->belongsTo('GSVnet\Users\User');
    }
}