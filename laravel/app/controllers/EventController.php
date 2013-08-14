<?php

class EventController extends BaseController {
	public function showIndex()
	{
		$this->layout->content = View::make('events.index');
	}

}