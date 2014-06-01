<?php namespace GSVnet\Events;

use Laracasts\Presenter\PresentableTrait;
use Carbon\Carbon;

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
        $date = Carbon::parse($this->start_date);
        $start = $date->format('Y-m-01');
        $end = $date->format('Y-m-t');
        $query = static::where('slug', '=', $slug)
                       ->where('id', '!=', $this->id)
                       ->where('start_date', '<=', $end)
                       ->where('start_date', '>=', $start);
        return $query->count();
    }

    private function generateSlugByIncrementer($i)
    {
        if ($i == 0) {
            $append = '';
        } else {
            $append = '-' . $i;
        }

        return \Str::slug($this->title . $append);
    }
}