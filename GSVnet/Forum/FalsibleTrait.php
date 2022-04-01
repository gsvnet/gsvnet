<?php namespace GSVnet\Forum;

trait FalsibleTrait {
    public function falselikes()
    {
        return $this->morphMany(Falselike::class, 'falsible');
    }
}
