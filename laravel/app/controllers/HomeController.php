<?php

use GSVnet\Events\EventsRepository;

class HomeController extends BaseController {

    protected $events;

    public function __construct(EventsRepository $events)
    {
    	parent::__construct();
        $this->events = $events;
    }

	public function showIndex()
	{
		// Get the coming events and show it in the sidebar
		$events = $this->events->upcoming(5);

        $this->layout->bodyID = 'home-page';
		$this->layout->content = View::make('index')
			->withEvents($events);
	}
}