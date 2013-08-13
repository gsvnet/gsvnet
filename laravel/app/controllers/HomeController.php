<?php

class HomeController extends BaseController {
	public function showIndex()
	{
		$this->layout->content = View::make('index');
	}

	public function wordLid()
	{
		$this->layout->content = View::make('word-lid');
	}

}