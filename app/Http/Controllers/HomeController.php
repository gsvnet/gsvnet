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

    public function showNewIndex()
    {
        // Temporary filter to decide which index page to show
        $ua = $_SERVER['HTTP_USER_AGENT'];
        //echo $ua;
        $browser = array();

        // Test ua
        //$ua = "Mozilla/5.0 (Linux; U; Android 4.0.3; de-ch; HTC Sensation Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";
        
        preg_match_all("/(Chromium|Chrome|Safari|Firefox|OPR|MSIE|version)[\/|\s]([\d]+)/i", $ua, $browser_matches);
        //print_r($browser_matches);

        $browser = array(
            'name' => '',
            'version' => ''
        );

        $freezeVersion = false;
        foreach($browser_matches[1] as $i => $match) {
            if(strtolower($match) == 'version') {
                $browser['version'] = $browser_matches[2][$i];
                $freezeVersion = true;
            } else {
                if($browser['name'] == '' || $browser['name'] == 'Safari') {
                    $browser['name'] = strtolower($match);
                    if(!$freezeVersion) {
                        $browser['version'] = $browser_matches[2][$i];
                    }
                }
            }
        }

        // Safari 9 might give JS errors
        $requirements = array(
            'chrome' => 29,
            'firefox' => 28,
            'safari' => 9,
            'opr' => 17
        );

        if(array_key_exists($browser['name'], $requirements) && $browser['version'] >= $requirements[$browser['name']]) {
            return view('index_new');
        } else {
            $this->showIndex();
        }
    }

    public function sponsorProgram()
    {
        return view('ad-page');
    }

    public function showKiezel()
    {
        return view('kiezel');
    }

    public function showCorona()
    {
        return view('corona');
    }
}