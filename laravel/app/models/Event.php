<?php namespace Model;

class Event extends \Eloquent {
	protected $guarded = array();

	public static $rules = array();


    // To do;
    //  convert $this->start_date naar correcte output
    public function day()
    {
        $start_date = new \DateTime($this->start_date);

        return $start_date->format('l');
    }

    public function date()
    {
        $start_date = new \DateTime($this->start_date);

        return $start_date->format('d F Y');
    }

    public function time()
    {
        $start_date = new \DateTime($this->start_date);

        return $start_date->format('H:i');
    }

    public function image()
    {
        // To do
        //  return /uploads/events/{event-id}-{event-name / image name}.{image extension}

        return 'http://lorempixel.com/126/126?a' . $this->id;
    }
}