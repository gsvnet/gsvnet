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
}