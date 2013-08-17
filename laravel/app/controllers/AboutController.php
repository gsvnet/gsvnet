<?php

class AboutController extends BaseController {

	public function showAbout()
	{
		$this->layout->content = View::make('de-gsv.de-gsv');
	}

    public function showCommittees()
    {
        $committees = Committee::all();

        $this->layout->content = View::make('de-gsv.committees')
            ->with('committees', $committees);
    }

}