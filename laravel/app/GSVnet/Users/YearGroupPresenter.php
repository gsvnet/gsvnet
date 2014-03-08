<?php namespace GSVnet\Users;

use BasePresenter, Carbon\Carbon;

class YearGroupPresenter extends BasePresenter
{
    public function __construct(YearGroup $yeargroup)
    {
        $this->resource = $yeargroup;
    }

    public function nameWithYear()
    {
        return $this->resource->name . ' (' . $this->resource->year . ')';
    }
}