<?php

use GSVnet\Events\EventsRepository;

class EventController extends BaseController {

    protected $events;

    public function __construct(EventsRepository $events)
    {
        $this->events = $events;
    }

	public function showIndex()
	{
        // Get all events which haven't finishes yet
        $events = $this->events->upcoming(5);
        $this->layout->content = View::make('events.index')
            ->with('searchTimeRange', false)
            ->with('events', $events)
            ->with('types', Config::get('gsvnet.eventTypes'));

        // Setup metadata
        $this->layout->title = 'Activiteiten - pagina ' . Input::get('page') . ' - GSVnet';
        $this->layout->description = 'Activiteiten van de GSV';
        $this->layout->keywords = 'Activiteiten, feesten, borrels';
        $this->layout->bodyID = 'events-page';
	}

    public function showMonth($year, $strMonth = false)
    {
        // Stores the month as number 01 ... 12
        $yearNumber = (int) $year;
        $months     = Config::get('gsvnet.months');

        // Create $start and $end variables, which represent the time spans.
        if($strMonth)
        {
            $month = $months[$strMonth];
            $begin = $year . '-' . $month . '-01';
            $end = (new DateTime($year . '-' . $month . '-01'))->format('Y-m-t');
        } else
        {
            $begin = $year . '-01-01';
            $end = $year . '-12-31';
        }

        // Select all events that take place between $start and $end
        $events = $this->events->between($begin, $end);

        // Make the view
        $this->layout->content = View::make('events.index')
            ->with('events',          $events)
            ->with('searchTimeRange', true)
            ->with('year',            $year)
            ->with('month',           $strMonth)
            ->with('types',           Config::get('gsvnet.eventTypes'));

        // Setup metadata
        $this->layout->title    = 'Activiteiten in ' . ($strMonth ? $strMonth : '') . ' ' . $year . ' - GSVnet';
        //$this->layout->description = $event->description;
        $this->layout->keywords = 'Activiteiten, feesten, borrels';
        $this->layout->bodyID = 'events-page';
    }

    public function showEvent($id)
    {
        $event  = $this->events->byId($id);

        $this->layout->content = View::make('events.show')
            ->with('event', $event)
            ->with('types', Config::get('gsvnet.eventTypes'));

        // Setup metadata
        $this->layout->title        = 'Activitiet - ' . $event->title . ' - GSVnet';
        $this->layout->description  = $event->description;
        $this->layout->keywords     = 'Activiteiten, feesten, borrels';
        $this->layout->bodyID       = 'single-event-page';
    }

}
