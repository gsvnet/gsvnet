<?php namespace GSVnet\Committees;

use Laracasts\Presenter\Presenter, Carbon\Carbon;

class CommitteePresenter extends Presenter
{

    public function from_to()
    {
        $from = Carbon::createFromFormat('Y-m-d H:i:s',   $this->pivot->start_date);

        $string = $from->formatLocalized("%Y");

        if( is_null(  $this->pivot->end_date) )
        {
            $string .= ' tot heden';
        } else
        {

            $to = Carbon::createFromFormat('Y-m-d H:i:s',   $this->pivot->end_date);
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