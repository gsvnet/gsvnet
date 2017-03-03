<?php namespace GSVnet\Forum;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {
    protected $table = 'likeable_likes';
    public $timestamps = true;
    protected $fillable = ['likable_id', 'likable_type', 'user_id'];

    public function likable()
    {
        return $this->morphTo();
    }
}