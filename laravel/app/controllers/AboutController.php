<?php

use GSVnet\Committees\CommitteesRepository;

class AboutController extends BaseController {


    public function __construct(CommitteesRepository $committees)
    {
        $this->committees = $committees;
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

        $this->layout->bodyID = 'committee-page';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->content = View::make('de-gsv.committees.show')
            ->with('committee', $committee)
            ->with('committees', $committees);
    }

    public function showSenates()
    {
        $this->layout->bodyID = 'senates-page';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->content = View::make('de-gsv.senates.index');
    }

    public function showSenate($senate)
    {
        $this->layout->bodyID = 'senate-page';
        $this->layout->activeMenuItem = 'de-gsv';
        $this->layout->content = View::make('de-gsv.senates.index');
        $this->layout->content->senate = View::make('de-gsv.senates.' . $senate);
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