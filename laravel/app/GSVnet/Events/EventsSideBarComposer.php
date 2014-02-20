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
        $options = Config::get('gsvnet.events');

        $months = array('januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');

        $view->withMonths($months);
        $view->with('showNextYear', $year < $options['maxYear'])
            ->with('showPrevYear', $year > $options['minYear']);

    }
}