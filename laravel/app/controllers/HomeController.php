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
		$events    = $this->events->upcoming(5);
        $birthdays = $this->profiles->byUpcomingBirthdays(1);

        $this->layout->bodyID = 'home-page';
        $this->layout->title = 'Gereformeerde Studenten Vereniging te Groningen';
        $this->layout->description = 'Denk je na over een actief studentenleven in Groningen? Dan ben je hier aan het juiste adres. De GSV is dé perfecte combinatie van christelijke waarden en het echte studentenleven.';
		$this->layout->content = View::make('index')->with([
            'events'    => $events,
            'birthdays' => $birthdays
        ]);
	}
}