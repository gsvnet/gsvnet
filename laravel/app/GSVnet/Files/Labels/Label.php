<?php namespace GSVnet\Files\Labels;

class Label extends \Eloquent {
    protected $fillable = ['name'];
    public $timestamps = false;

    public function files()
    {
        return $this->belongsToMany('GSVnet\Files\File', 'file_label');
    }

    public function __toString()
    {
        return $this->name;
    }
}
