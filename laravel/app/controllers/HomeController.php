<?php

class HomeController extends BaseController {
	public function showIndex()
	{
        $this->layout->bodyID = 'home-page';
		$this->layout->content = View::make('index');
	}

	public function wordLid()
	{
        $this->layout->bodyID = 'become-member-page';
		$this->layout->content = View::make('word-lid.word-lid');
	}

}