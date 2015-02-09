<?php namespace GSVnet\Events;

use Config;

class EventsSideBarComposer {

    protected $events;

    public function __construct(EventsRepository $events)
    {
        $this->events = $events;
    }

    public function compose($view)
    {
        // if view does not have year, set year to current
        if (! isset($view->year))
        {
            // Get current year
            $year = (int) date('Y');
            $view->withYear($year);
        }

        $year = $view->year;

        $months = array('januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');
        $visibleYears = $this->getVisibleYears($year);


        $view->withMonths($months);
        $view->with('visibleYears', $visibleYears);

    }

    private function getVisibleYears($year)
    {
        $options = Config::get('gsvnet.events');
        
        // Create list of visible years
        $yearsList = array();
        
        // Previous year
        if($options['minYear'] < $year)
        {
            $yearsList[] = $year - 1;
        }

        // Current year
        $yearsList[] = $year;

        // Next year
        if($options['maxYear'] > $year)
        {
            $yearsList[] = $year + 1;
        }

        return $yearsList;
    }
}