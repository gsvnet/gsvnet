<?php

class EventController extends BaseController {
	public function showIndex()
	{

        // Get all events which haven't finishes yet
        $events = Model\Event::where('end_date', '>=', new \DateTime('now'))
            ->orderBy('start_date', 'asc')
            ->paginate(5);

        $this->layout->content = View::make('events.index')->with('events', $events);
        // Setup metadata
        $this->layout->title = 'Activiteiten - pagina ' . Input::get('page') . ' - GSVnet';
        $this->layout->description = 'Activiteiten van de GSV';
        $this->layout->keywords = 'Activiteiten, feesten, borrels';
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
    }

    public function showMonth($year, $month = false)
    {
        return 'poep et kack';
    }

}