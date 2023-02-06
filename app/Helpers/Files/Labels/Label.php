<?php namespace GSV\Helpers\Files\Labels;

use Illuminate\Database\Eloquent\Model;

class Label extends Model {
    protected $fillable = ['name'];
    public $timestamps = false;

    public function files()
    {
        return $this->belongsToMany('GSV\Helpers\Files\File', 'file_label');
    }

    public function __toString()
    {
        return $this->name;
    }
}
