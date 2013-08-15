<?php

class EventController extends BaseController {
	public function showIndex()
	{
        // Get all events which haven't finishes yet
        //  order on start time such that
        //
        //  $events = Event::where('start_date', '>=', new \DateTime('today'))
              // ->where('end_date', '<=', new \DateTime('now'))
              // ->orderBy('start_date', 'desc')
              // ->get();
        //
        $events = Model\Event::where('end_date', '>=', new \DateTime('now'))
            ->orderBy('start_date', 'asc')
            ->get();

		$this->layout->content = View::make('events.index')->with('events', $events);
	}

}