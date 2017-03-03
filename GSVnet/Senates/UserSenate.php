<?php namespace GSVnet\Senates;

use Illuminate\Database\Eloquent\Model;

class UserSenate extends Model {

    protected $table    = 'user_senate';

    protected $fillable = ['function'];

    public function user()
    {
        return $this->belongsTo('GSVnet\Users\User');
    }

    public function senate()
    {
        return $this->belongsTo('GSVnet\Senates\Senate');
    }
}