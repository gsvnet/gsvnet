<?php namespace GSVnet\Events;

use Laracasts\Presenter\Presenter, Carbon\Carbon;

class EventPresenter extends Presenter
{
   public function start_long()
    {
    	$string = Carbon::createFromFormat('Y-m-d',   $this->start_date)
                     ->toFormattedDateString();

    	if(  $this->whole_day == '0')
    	{
    		$string .= ' om ' . Carbon::createFromFormat('H:i:s',   $this->start_time)->format('H:i');
    	}

        return $string;
    }

    public function start_short()
    {
    	$string = Carbon::createFromFormat('Y-m-d',   $this->start_date)
                     ->formatLocalized('%d %b');

    	if(  $this->whole_day == '0')
    	{
    		$string .= ' ' . Carbon::createFromFormat('H:i:s',   $this->start_time)->format('H:i');
    	}

        return $string;
    }

    /*
     * Without year: [day] [mnth] tot [day] [mnth]
     * Shows first month only when it is different
     */
    public function from_to_short()
    {
        $showMonth = false;
        $string = '';
        $from = Carbon::createFromFormat('Y-m-d',   $this->start_date);
        $to = Carbon::createFromFormat('Y-m-d',   $this->end_date);


        // 'vandaag', 'morgen', '[day] [mnth]'
        if( $from->isToday() )
        {
            $string .= 'Vandaag';
        } elseif( $from->isTomorrow() )
        {
            $string .= 'Morgen';
        } else 
        {
            $showMonth = true;

            $string .= $from->formatLocalized('%e');        

            // Display month and year only twice if necessary
            // Hopefully an events doesnt take more than a year :G
            if($from->month != $to->month)
            {
                $string .= $from->formatLocalized(' %b');
            }
            
        }

        // Check if the end date is different
        if( $from->format('Y-m-d') != $to->format('Y-m-d') )
        {
            $string .= ' tot ' . $to->formatLocalized('%e %b');
        } elseif($showMonth) {
            $string .= $from->formatLocalized(' %b');
        }

        if(   $this->whole_day == '0' && !is_null(  $this->start_time) )
        {
            $time = Carbon::createFromFormat('H:i:s',   $this->start_time);
            $string .= ' om ' . $time->format('H:i');
        }

        return $string;
    }

    /*
     * [day] [mnth] tot [day] [mnth]
     * Shows first month only when it is different
     */
    public function from_to_long($year = false)
    {
        $string = '';
        $from = Carbon::createFromFormat('Y-m-d',   $this->start_date);
        $to = Carbon::createFromFormat('Y-m-d',   $this->end_date);

        $string .= $from->formatLocalized('%e');        

        // Display month and year only twice if necessary
        if($from->month != $to->month)
        {
            $string .= $from->formatLocalized(' %B');
        }

        // Check if year is different and then display it
        if($year and $from->year != $to->year)
        {
            $string .= $from->format(' Y');
        }

        // Check if the end date is different
        if($from->format('Y-m-d') != $to->format('Y-m-d'))
        {
            $string .= ' tot ' . $to->formatLocalized('%e %B');
        } else {
            $string .= $to->formatLocalized(' %B');
        }

        // Add the year if necessary
        if($year)
        {
            $string .= $to->format(' Y');
        }

        // Show time
        if(  $this->whole_day == '0')
        {
            $time = Carbon::createFromFormat('H:i:s',   $this->start_time);
            $string .= ' om ' . $time->format('H:i');
        }

        return $string;
    }

    public function startHourMinute()
    {
        if( !is_null(  $this->start_time) )
        {
            $time = Carbon::createFromFormat('H:i:s',   $this->start_time);
            return $time->format('H:i:s');
        }

        return '';
    }
}