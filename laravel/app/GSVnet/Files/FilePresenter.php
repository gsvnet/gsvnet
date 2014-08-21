<?php namespace GSVnet\Files;

use Laracasts\Presenter\Presenter;
use GSVnet\Carbon as GSVCarbon;

class EventPresenter extends Presenter
{
    public function updated_ago()
    {
        $updated = new GSVCarbon($this->updated_at);
        return $updated->diffForHumans();
    }
}