<?php namespace GSVnet\Users;

use Laracasts\Presenter\Presenter;

class YearGroupPresenter extends Presenter
{

    public function nameWithYear()
    {
        return $this->name . ' (' .   $this->year . ')';
    }
}