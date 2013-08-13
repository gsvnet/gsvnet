<?php

class AboutController extends BaseController {

	public function showAbout()
	{
		$this->layout->content = View::make('de-gsv.de-gsv');
	}

}