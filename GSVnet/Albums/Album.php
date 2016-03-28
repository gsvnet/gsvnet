<?php namespace GSVnet\Albums;

use Illuminate\Support\Str;
use URL;
use Illuminate\Database\Eloquent\Model;

class Album extends Model {

    protected $fillable = array('name', 'description');

    public static $rules = array(
        'name'        => 'required',
        'description' => 'required'
    );

    public function scopePublic($query)
    {
        return $query->wherePublic(true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('updated_at', 'DESC');
    }

    public function photos()
    {
        return $this->hasMany('GSVnet\Albums\Photos\Photo');
    }

    public function getSmallImageURLAttribute()
    {
        $photo = $this->photos->first();
        return $photo->small_image_url;
    }

    public function getWideImageURLAttribute()
    {
        $photo = $this->photos->first();
        return $photo->wide_image_url;
    }

    public function getShowURLAttribute()
    {
        return URL::action('PhotoController@showPhotos', $this->slug);
    }

    // Return the path to the original image
    public function getImageURLAttribute()
    {
        return URL::action('PhotoController@showPhotos', $this->slug);
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
        if ($i == 0)
        {
            $append = '';
        } else
        {
            $append = '-' . $i;
        }

        return Str::slug("{$this->name}" . $append);
    }
}