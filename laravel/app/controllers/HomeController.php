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

	public function wordLid()
	{
		$activeStep = '';

		// Create steps of form
		$steps = [
			'login-or-register' => [
				'text' => '1. Inloggen of registreren', 
				'active' => !Auth::check()
			],
			'become-member' => [
				'text' => '2. Gegevens invullen', 
				'active' => Permission::has('become-member')
			],
			'all-done' => [ 
				'text' => '3. Klaar!', 
				'active' => Auth::check() && Auth::user()->type == 'potential'
			]
		];

		// Find the active step
		foreach($steps as $key=>$value)
		{
			if($steps[$key]['active'])
			{
				$activeStep = $key;
				break;
			}
		}

        $this->layout->bodyID = 'become-member-page';
		$this->layout->content = View::make('word-lid.word-lid')
			->with('steps', $steps)
			->with('activeStep', $activeStep);
	}

}