<?php

namespace App\Helpers\Tags;

use App\Helpers\Core\Entity;

class Tag extends Entity
{
    protected $table = 'tags';

    protected $fillable = ['name', 'slug', 'description', 'articles', 'forum'];

    public $timestamps = false;

    protected $validationRules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    public function newCollection(array $models = [])
    {
        return new TagCollection($models);
    }
}
