<?php namespace App\Helpers\Senates;

use Illuminate\Database\Eloquent\Model;

class UserSenate extends Model {

    protected $table    = 'user_senate';

    protected $fillable = ['function'];

    public function user()
    {
        return $this->belongsTo('App\Helpers\Users\User');
    }

    public function senate()
    {
        return $this->belongsTo('App\Helpers\Senates\Senate');
    }
}