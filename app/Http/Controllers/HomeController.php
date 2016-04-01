<?php

use GSVnet\Events\EventsRepository;
use GSVnet\Users\Profiles\ProfilesRepository;

class HomeController extends BaseController {

    protected $events;
    protected $profiles;

    public function __construct(EventsRepository $events, ProfilesRepository $profiles)
    {
    	parent::__construct();
        $this->events = $events;
        $this->profiles = $profiles;
    }

	public function showIndex()
	{
		// Get the coming events and show it in the sidebar
		$events = $this->events->upcoming(5);
        $birthdays = $this->profiles->byUpcomingBirthdays(1);

        return view('index')->with([
            'events' => $events,
            'birthdays' => $birthdays
        ]);
	}

    public function sponsorProgram()
    {
        $this->authorize('sponsor-program.show');
        return view('ad-page');
    }
}