<?php

class AboutController extends BaseController {

	public function showAbout()
	{
		$this->layout->content = View::make('de-gsv.de-gsv');
	}

    public function showCommittees()
    {
        $committees = Model\Committee::all();

        $this->layout->bodyID = 'committees-page';
        $this->layout->content = View::make('de-gsv.committees.index')
            ->with('committees', $committees);
    }

    public function showCommittee($id)
    {
        $committee = Model\Committee::find($id);
        $committees = Model\Committee::all();

        $this->layout->bodyID = 'committee-page';
        $this->layout->content = View::make('de-gsv.committees.show')
            ->with('committee', $committee)
            ->with('committees', $committees);
    }

    public function showSenates()
    {
        $this->layout->bodyID = 'senates-page';
        $this->layout->content = View::make('de-gsv.senates.index');
    }

    public function showSenate($senate)
    {
        $this->layout->bodyID = 'senate-page';
        $this->layout->content = View::make('de-gsv.senates.index');
        $this->layout->content->senate = View::make('de-gsv.senates.' . $senate);
    }

    public function showContact()
    {
        $this->layout->bodyID = 'contact-page';
        $this->layout->content = View::make('de-gsv.contact');
    }

}