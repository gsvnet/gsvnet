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
        return 'uploads/events/originals/' . $this->image;
    }

    // //  return /uploads/events/{event-id}-{image name}.{image extension}
    // public function image()
    // {
    //     // Find all files corresponding to /public/uploads/events/{event-id}-{image name}.{image extension}
    //     //
    //     // public/uploads/events/17-.*\.(jpg|jpeg|png|bmp|)
    //     $files = glob("public/uploads/events/" . $this->id . "-*");

    //     if (count($files) > 0)
    //     {
    //         // Select 1 file and remove /public from string
    //         return $file = preg_replace('/^public/', '', $files[0]);
    //     }
    //     return '';
    // }

    public function getImageAttribute()
    {
        // Find all files corresponding to /public/uploads/events/{event-id}-{image name}.{image extension}
        //
        // public/uploads/events/17-.*\.(jpg|jpeg|png|bmp|)
        $files = glob("public/uploads/events/" . $this->id . "-*");

        if (count($files) > 0)
        {
            // Select 1 file and remove /public from string
            return $file = preg_replace('/^public/', '', $files[0]);
        }
        return '';
    }
}