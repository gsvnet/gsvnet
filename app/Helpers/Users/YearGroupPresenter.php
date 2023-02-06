<?php namespace App\Helpers\Users;

use Laracasts\Presenter\Presenter;

class YearGroupPresenter extends Presenter
{
    public function name()
    {
        $name = $this->entity->name;
        return $name ? $name : 'Geen jaarverband';
    }

    public function nameWithYear()
    {
        return $this->name . ' (' .   $this->year . ')';
    }
}