<?php

class EventController extends BaseController {
	public function showIndex()
	{

        // Get all events which haven't finishes yet
        $events = Model\Event::where('end_date', '>=', new \DateTime('now'))
            ->orderBy('start_date', 'asc')
            ->paginate(5);

        $types = Config::get('gsvnet.eventTypes');

        $year = (int) date('Y');

        $this->layout->content = View::make('events.index')
            ->with('searchTimeRange', false)
            ->with('events', $events)
            ->with('types', $types)
            ->withYear($year);

        // Setup metadata
        $this->layout->title = 'Activiteiten - pagina ' . Input::get('page') . ' - GSVnet';
        $this->layout->description = 'Activiteiten van de GSV';
        $this->layout->keywords = 'Activiteiten, feesten, borrels';
        $this->layout->bodyID = 'events-page';
	}

    public function showEvent($id)
    {
        $event = Model\Event::find($id);
        $events = Model\Event::where('end_date', '>=', new \DateTime('now'))
            ->orderBy('start_date', 'asc')
            ->paginate(5);

        $this->layout->content = View::make('events.show')
            ->with('events', $events)
            ->with('event', $event);
        // Setup metadata
        $this->layout->title = 'Activitiet - ' . $event->title . ' - GSVnet';
        $this->layout->description = $event->description;
        $this->layout->keywords = 'Activiteiten, feesten, borrels';
        $this->layout->bodyID = 'show-event-page';
    }

    public function showMonth($year, $strMonth = false)
    {
        // Stores the month as number 01 ... 12
        // TODO MOVE DATA!!1! to some place where it belongs
        $month = '';
        $yearNumber = (int) $year;
        $currentYear = (int) date('Y');
        $convertDate = array(
            'januari' => '01',
            'februari' => '02',
            'maart' => '03',
            'april' => '04',
            'mei' => '05',
            'juni' => '06',
            'juli' => '07',
            'augustus' => '08',
            'september' => '09',
            'oktober' => '10',
            'november' => '11',
            'december' => '12',
        );

        // Limit the years
        if($yearNumber > $currentYear + 1 || $yearNumber < $currentYear - 5)
        {
            App::abort(404);
        }

        // If strMonth is given but it does not exist, then 404
        // Create $start and $end variables, which represent the time spans.
        if($strMonth)
        {
            if(array_key_exists($strMonth, $convertDate)) {
                $month = $convertDate[$strMonth];
            } else {
                App::abort(404);
            }

            $begin = $year . '-' . $month . '-01';
            $end = (new DateTime($year . '-' . $month . '-01'))->format('Y-m-t');
        } else
        {
            $begin = $year . '-01-01';
            $end = $year . '-12-31';
        }

        // Select all events that take place between $start and $end
        $events = Model\Event::where('start_date', '<=', $end)
            ->orderBy('start_date', 'asc')
            ->where('end_date', '>=', $begin)
            ->paginate(5);

        // Make the view
        $this->layout->content = View::make('events.index')
            ->with('events', $events)
            ->with('searchTimeRange', true)
            ->with('year', $year)
            ->with('month', $strMonth);

        // Setup metadata
        $this->layout->title = 'Activiteiten in ' . ($strMonth ? $strMonth : '') . ' ' . $year . ' - GSVnet';

        //$this->layout->description = $event->description;
        $this->layout->keywords = 'Activiteiten, feesten, borrels';
    }

}