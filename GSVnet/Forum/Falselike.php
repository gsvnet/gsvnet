<?php

namespace GSVnet\Forum;

use GSVnet\Users\User;
use Illuminate\Database\Eloquent\Model;

class Falselike extends Model {
    protected $table = 'falsible_falselikes';
    public $timestamps = true;
    protected $fillable = ['falsible_id', 'falsible_type', 'user_id'];

    public function falsible()
    {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}