<?php namespace Model;

class Event extends \Eloquent {
	protected $guarded = array();

	public static $rules = array();


    // To do;
    //  convert $this->start_date naar correcte output
    public function day()
    {
        return 'donderdag';
    }

    public function date()
    {
        return '8 augustus 2013';
    }

    public function time()
    {
        return '22:00';
    }

    public function image()
    {
        // To do
        //  return /uploads/events/{event-id}-{event-name / image name}.{image extension}

        return 'http://lorempixel.com/126/126?a' . $this->id;
    }
}