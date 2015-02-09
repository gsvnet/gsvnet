<?php namespace GSVnet\Users;

use Laracasts\Presenter\Presenter, Carbon\Carbon;

class YearGroupPresenter extends Presenter
{

    public function nameWithYear()
    {
        return $this->name . ' (' .   $this->year . ')';
    }
}