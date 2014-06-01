<?php namespace GSVnet\Events;

use Laracasts\Presenter\PresentableTrait;

class Event extends \Eloquent {

    use PresentableTrait;
    
    protected $guarded = array();

    public $presenter = 'GSVnet\Events\EventPresenter';

    public function scopePublic($query)
    {
        return $query->wherePublic(true);
    }

    public function scopePublished($query, $published = true)
    {
        if (! $published) { return $query; }
        return $query->wherePublished($published);
    }

    public function getUpdatedAtAttribute($updatedAt)
    {
        $date = new \Carbon\Carbon($updatedAt);

        return $date->diffForHumans();
    }

    public function getPublicAttribute($value)
    {
        return $value == 1 ? true : null;
    }

    public function getPublishedAttribute($value)
    {
        return $value == 1 ? true : null;
    }

    public function generateNewSlug()
    {
        $i = 0;

        while ($this->getCountBySlug($this->generateSlugByIncrementer($i)) > 0) {
            $i++;
        }

        return $this->generateSlugByIncrementer($i);
    }

    private function getCountBySlug($slug)
    {
        $query = static::where('slug', '=', $slug);

        if ($this->exists) {
            $query->where('id', '!=', $this->id);
        }

        return $query->count();
    }

    private function generateSlugByIncrementer($i)
    {
        if ($i == 0) {
            $append = '';
        } else {
            $append = '-' . $i;
        }

        if ($this->start_date) {
            $date = date('d-m-Y', strtotime($this->start_date));
        } else {
            $date = date('d-m-Y');
        }

        return \Str::slug($date . "-" . $this->title . $append);
    }
}