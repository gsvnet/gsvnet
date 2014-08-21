<?php namespace GSVnet\Files;

use Laracasts\Presenter\Presenter;
use GSVnet\Carbon as GSVCarbon;

class FilePresenter extends Presenter
{
    public function updated_ago()
    {
        $updated = new GSVCarbon($this->updated_at);
        return $updated->diffForHumans();
    }
}