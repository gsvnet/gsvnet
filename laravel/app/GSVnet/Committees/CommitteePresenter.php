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
        $from = Carbon::createFromFormat('Y-m-d H:i:s', $this->resource->pivot->start_date);

        $string = $from->formatLocalized("%Y");

        if( is_null($this->resource->pivot->end_date) )
        {
            $string .= ' tot heden';
        } else
        {

            $to = Carbon::createFromFormat('Y-m-d H:i:s', $this->resource->pivot->end_date);
            if($to->isFuture())
            {
                $string .= ' tot heden';
            }
            else 
            {
                $string .= ' tot ';
                $string .= $to->formatLocalized("%Y");
            }
        }
        return $string;
    }
}