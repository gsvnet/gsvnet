<?php namespace GSV\Helpers\Files;

use Laracasts\Presenter\Presenter;

class FilePresenter extends Presenter
{
    public function updated_ago()
    {
        return $this->entity->updated_at->diffForHumans();
    }
}