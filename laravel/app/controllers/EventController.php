<?php

use GSVnet\Events\EventsRepository;
use Carbon\Carbon;

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
        if(Input::has('page'))
        {
            $this->layout->title = 'Activiteiten - pagina ' . Input::get('page');
        } else 
        {
            $this->layout->title = 'Activiteiten van de GSV';
        }
        $this->layout->description = 'Hier is te vinden welke activiteiten de GSV allemaal op haar agenda heeft staan.';
        $this->layout->activeMenuItem = 'activiteiten';
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
        $this->layout->title    = 'Activiteiten in ' . ($strMonth . ' ' ? $strMonth : '') . $year;
        $this->layout->description = 'Activiteiten in ' . ($strMonth . ' ' ? $strMonth : '') . $year;
        $this->layout->activeMenuItem = 'activiteiten';
        $this->layout->keywords = 'Activiteiten, feesten, borrels';
        $this->layout->bodyID = 'events-page';
    }

    public function showEvent($year, $month, $slug)
    {
        $date = Carbon::createFromDate($year, Config::get("gsvnet.months.$month"), 1);
        $event = $this->events->byYearMonthSlug($date, $slug);

        $this->layout->content = View::make('events.show')
            ->with('event', $event)
            ->with('types', Config::get('gsvnet.eventTypes'));

        // Setup metadata
        $this->layout->title        = $event->title . ' - activiteiten';
        $this->layout->description  = $event->meta_description;
        $this->layout->activeMenuItem = 'activiteiten';
        $this->layout->keywords     = 'Activiteiten, feesten, borrels';
        $this->layout->bodyID       = 'single-event-page';
    }
}
