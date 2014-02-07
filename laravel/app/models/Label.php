<?php namespace Model;

class Label extends \Eloquent {
    protected $fillable = ['name'];
    public $timestamps = false;

    public function files()
    {
        return $this->belongsToMany('Model\File', 'file_label');
        $this->hasMany('Model\Files');
    }

    public function __toString()
    {
        return $this->name;
    }
}
