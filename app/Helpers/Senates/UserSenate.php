<?php namespace GSV\Helpers\Senates;

use Illuminate\Database\Eloquent\Model;

class UserSenate extends Model {

    protected $table    = 'user_senate';

    protected $fillable = ['function'];

    public function user()
    {
        return $this->belongsTo('GSV\Helpers\Users\User');
    }

    public function senate()
    {
        return $this->belongsTo('GSV\Helpers\Senates\Senate');
    }
}