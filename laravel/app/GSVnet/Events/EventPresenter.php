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
    	$string = Carbon::createFromFormat('Y-m-d', $this->resource->start_date)
                     ->toFormattedDateString();

    	if($this->resource->whole_day == '0')
    	{
    		$string .= ' om ' . Carbon::createFromFormat('H:i:s', $this->resource->start_time)->format('H:i');
    	}

        return $string;
    }

    public function start_short()
    {
    	$string = Carbon::createFromFormat('Y-m-d', $this->resource->start_date)
                     ->formatLocalized('%d %b');

    	if($this->resource->whole_day == '0')
    	{
    		$string .= ' ' . Carbon::createFromFormat('H:i:s', $this->resource->start_time)->format('H:i');
    	}

        return $string;
    }

    /*
     * Without year: [day] [mnth] tot [day] [mnth]
     * Shows first month only when it is different
     */
    public function from_to_short()
    {
        $string = '';
        $from = Carbon::createFromFormat('Y-m-d', $this->resource->start_date);
        $to = Carbon::createFromFormat('Y-m-d', $this->resource->end_date);
        $time = Carbon::createFromFormat('H:i:s', $this->resource->start_time);

        $string .= $from->formatLocalized('%e');        

        // Display month and year only twice if necessary
        // Hopefully an events doesnt take more than a year :G
        if($from->month != $to->month)
        {
            $string .= $from->formatLocalized(' %b');
        }

        // Check if the end date is different
        if($from->format('Y-m-d') != $to->format('Y-m-d'))
        {
            $string .= ' tot ' . $to->formatLocalized('%e %b');
        } else {
            $string .= $from->formatLocalized(' %b');
        }

        if($this->resource->whole_day == '0')
        {
            $string .= ' om ' . $time->format('H:i');
        }

        return $string;
    }

    /*
     * Without year: [day] [mnth] tot [day] [mnth]
     * Shows first month only when it is different
     */
    public function from_to_long()
    {
        $string = '';
        $from = Carbon::createFromFormat('Y-m-d', $this->resource->start_date);
        $to = Carbon::createFromFormat('Y-m-d', $this->resource->end_date);
        $time = Carbon::createFromFormat('H:i:s', $this->resource->start_time);

        $string .= $from->formatLocalized('%e');        

        // Display month and year only twice if necessary
        // Hopefully an events doesnt take more than a year :G
        if($from->month != $to->month)
        {
            $string .= $from->formatLocalized(' %B');
        }

        // Check if the end date is different
        if($from->format('Y-m-d') != $to->format('Y-m-d'))
        {
            $string .= ' tot ' . $to->formatLocalized('%e %B');
        } else {
            $string .= $from->formatLocalized(' %B');
        }

        if($this->resource->whole_day == '0')
        {
            $string .= ' om ' . $time->format('H:i');
        }

        return $string;
    }
}