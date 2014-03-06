<?php

use GSVnet\Committees\CommitteesRepository;
use GSVnet\Senates\SenatesRepository;

class AboutController extends BaseController {


    public function __construct(CommitteesRepository $committees, SenatesRepository $senates)
    {
        $this->committees = $committees;
        $this->senates = $senates;
    }

	public function showAbout()
	{
		$this->layout->content = View::make('de-gsv.de-gsv');
        $this->layout->activeMenuItem = 'de-gsv';
    }

    public function showCommittees()
    {
        $committees = $this->committees->all();

        $this->layout->bodyID = 'committees-page';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->content = View::make('de-gsv.committees.index')
            ->with('committees', $committees);
    }

    public function showCommittee($slug)
    {
        $committee = $this->committees->bySlug($slug);
        $committees = $this->committees->all();
        $activeMembers = $committee->activeMembers;

        $this->layout->bodyID = 'committee-page';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->content = View::make('de-gsv.committees.show')
            ->with('committee', $committee)
            ->with('committees', $committees)
            ->with('activeMembers', $activeMembers);
    }

    public function showSenates()
    {
        $senates = $this->senates->all();

        $this->layout->bodyID = 'senates-page';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->content = View::make('de-gsv.senates.index')
            ->with('senates', $senates);
    }

    public function showSenate($id)
    {
        $senates = $this->senates->all();
        $senate = $this->senates->byId($id);
        $members = $senate->members()->get();
        
        $this->layout->bodyID = 'senate-page';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->content = View::make('de-gsv.senates.single')
            ->with('currentSenate', $senate)
            ->with('senates', $senates)
            ->with('members', $members);
    }

    public function showContact()
    {
        $this->layout->bodyID = 'contact-page';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->content = View::make('de-gsv.contact');
    }

    public function showPillars()
    {
        $this->layout->bodyID = 'pillars-page';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->content = View::make('de-gsv.pillars');
    }

    public function showHistory()
    {
        $this->layout->bodyID = 'history-page';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->content = View::make('de-gsv.history');
    }
}