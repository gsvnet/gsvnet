<?php namespace GSVnet\Events;

class Event extends \Eloquent {
    protected $guarded = array();

    public function scopePublic($query)
    {
        return $query->wherePublic(true);
    }

    public function scopePublished($query, $published = true)
    {
        if (! $published) { return $query; }
        return $query->wherePublished($published);
    }


    // TODO: lijkt nog niet te werken met accessors?
    // public function getDates()
    // {
    //     return array('created_at', 'updated_at', 'deleted_at', 'start_date', 'end_date');
    // }


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

    public function getStartDateFormattedAttribute()
    {
        $date = new \Carbon\Carbon($this->start_date);

        return $date->formatLocalized('%d %b');
    }

    public function getEndDateFormattedAttribute($start_date)
    {
        $date = new \Carbon\Carbon($start_date);

        return $date->format('d M Y');
    }

    public function getUpdatedAtAttribute($updatedAt)
    {
        $date = new \Carbon\Carbon($updatedAt);

        return $date->diffForHumans();
    }

    public function image()
    {
        return 'http://lorempixel.com/126/126/abstract?id=' . rand();
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

    public function hoi()
    {
        $start_date = new \Carbon\Carbon($this->start_date);
        $end_date = new \Carbon\Carbon($this->end_date);


        if ($start_date->diffInHours($end_date) < 24)
        {
            return "Van " . $start_date->format('l d F Y H:i') . " tot " . $end_date->format('H:i') . '.';
        }
        else
        {
            // if ($start_date->format('H:i') === $end_date->format('H:i'))
            // {
            //     return "Van " . $start_date->format('l d F Y H:i') . " tot " . $end_date->format('l d F') . '.';
            // }
            // else
            // {
                return "Van " . $start_date->format('l d F Y H:i') . " tot " . $end_date->format('l d F H:i') . '.';
            // }
        }

        // length is less than 24 hours
        // van start dag, maand, tijd tot eind tijd

        // van start dag maand, tijd tot eind dag, tijd

    }

    public function getPublicAttribute($value)
    {
        return $value == 1 ? true : null;
    }

    public function getPublishedAttribute($value)
    {
        return $value == 1 ? true : null;
    }
}