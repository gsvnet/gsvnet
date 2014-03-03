<?php namespace GSVnet\Committees;

use BasePresenter, Carbon\Carbon;

class CommitteePresenter extends BasePresenter
{
    public function __construct(Committee $committee)
    {
        $this->resource = $committee;
    }

    public function from_to()
    {
    	$string = Carbon::createFromFormat('Y-m-d H:i:s', $this->resource->pivot->start_date, 'Europe/Amsterdam')->toFormattedDateString();

    	if( !is_null($this->resource->pivot->end_date) )
    	{
    		$string .= ' tot ';
    		$string .= Carbon::createFromFormat('Y-m-d H:i:s', $this->resource->pivot->end_date, 'Europe/Amsterdam')->toFormattedDateString();
    	}
        return $string;
    }
}