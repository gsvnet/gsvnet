<?php namespace GSVnet\Forum;

trait LikableTrait {
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }
}