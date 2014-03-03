<?php namespace GSVnet\Events;

use BasePresenter, Carbon\Carbon;

class EventPresenter extends BasePresenter
{
    public function __construct(Event $event)
    {
        $this->resource = $event;
    }

    public function formatted_start_date()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->resource->start_date, 'Europe/Amsterdam')
                     ->toFormattedDateString();
    }
}