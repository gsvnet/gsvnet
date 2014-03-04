<?php namespace GSVnet\Senates;

use BasePresenter, Carbon\Carbon;

class SenatePresenter extends BasePresenter
{
    public function __construct(Senate $senate)
    {
        $this->resource = $senate;
    }

    public function nameWithYear()
    {
        $string = $this->resource->name;
        $string .= ' (';
    	$string .= Carbon::createFromFormat('Y-m-d', $this->resource->start_date)->format('Y');
        $string .= ')';

        return $string;
    }
}