<?php

namespace App\Helpers\Forum;

trait LikableTrait
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }
}
