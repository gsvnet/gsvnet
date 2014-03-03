<?php namespace GSVnet\Events;

use BasePresenter, Carbon\Carbon;

class EventPresenter extends BasePresenter
{
    public function __construct(Event $event)
    {
        $this->resource = $event;
    }

    /*
     *
     */
    public function start_long()
    {
    	$string = Carbon::createFromFormat('Y-m-d H:i:s', $this->resource->start_date, 'Europe/Amsterdam')
                     ->toFormattedDateString();

    	if($this->resource->whole_day == '0')
    	{
    		$string .= ' om ' . Carbon::createFromFormat('H:i:s', $this->resource->start_time)->format('H:i');
    	}

        return $string;
    }

    public function start_short()
    {
    	$string = Carbon::createFromFormat('Y-m-d H:i:s', $this->resource->start_date, 'Europe/Amsterdam')
                     ->formatLocalized('%d %b');

    	if($this->resource->whole_day == '0')
    	{
    		$string .= ' ' . Carbon::createFromFormat('H:i:s', $this->resource->start_time)->format('H:i');
    	}

        return $string;
    }
}