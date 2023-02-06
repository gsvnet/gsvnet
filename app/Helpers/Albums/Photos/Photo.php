<?php

namespace App\Helpers\Albums\Photos;

use Illuminate\Database\Eloquent\Model;
use URL;

class Photo extends Model
{
    // Define the dimensions of small and wide photos

    protected $fillable = ['name', 'src_path', 'album_id'];

    protected $imageHandler;

    public static $rules = [
        'album_id' => 'required|integer',
    ];

    // The photo's album
    public function album()
    {
        return $this->belongsTo('App\Helpers\Albums\Album');
    }

    // Return the path to the original image
    public function getShowURLAttribute()
    {
        return URL::action('PhotoController@showPhoto', [$this->id]);
    }

    // Return the path to the original image
    public function getImageURLAttribute()
    {
        return URL::action('PhotoController@showPhoto', [$this->id]);
    }

    // Return the path to the original image
    public function getWideImageURLAttribute()
    {
        return URL::action('PhotoController@showPhoto', [$this->id, 'wide']);
    }

    // Return the path to the original image
    public function getSmallImageURLAttribute()
    {
        return URL::action('PhotoController@showPhoto', [$this->id, 'small']);
    }
}
