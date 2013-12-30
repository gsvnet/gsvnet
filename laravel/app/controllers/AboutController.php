<?php

class AboutController extends BaseController {

	public function showAbout()
	{
		$this->layout->content = View::make('de-gsv.de-gsv');
	}

    public function showCommittees()
    {
        $committees = Model\Committee::all();

        $this->layout->content = View::make('de-gsv.committees.index')
            ->with('committees', $committees);
    }

    public function showCommittee($id)
    {
        $committee = Model\Committee::find($id);
        $committees = Model\Committee::all();

        $this->layout->content = View::make('de-gsv.committees.show')
            ->with('committee', $committee)
            ->with('committees', $committees);
    }

    public function showSenates()
    {
        $this->layout->content = View::make('de-gsv.senates.index');
    }

    public function showSenate($senate)
    {
        $this->layout->content = View::make('de-gsv.senates.index');
        $this->layout->content->senate = View::make('de-gsv.senates.' . $senate);
    }

    public function showContact()
    {
        $this->layout->content = View::make('de-gsv.contact');
    }

}