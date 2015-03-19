<?php namespace GSVnet\Events;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Event extends Model {

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
                       ->where('start_date', '<=', $end)
                       ->where('start_date', '>=', $start);

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

        return Str::slug($this->title . $append);
    }
}