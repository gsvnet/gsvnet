<?php

namespace App\Helpers\Forum\Threads;

use App;
use App\Helpers\Core\FormModel;
use Validator;

class ThreadForm extends FormModel
{
    protected $validationRules = [
        'subject' => 'required|min:3',
        'body' => 'required',
        'tags' => 'required|max_tags:3',
    ];

    protected function beforeValidation()
    {
        Validator::extend('max_tags', function ($attribute, $tagIds, $params) {
            $maxCount = $params[0];

            $tagRepo = App::make(\App\Helpers\Tags\TagRepository::class);
            $tags = $tagRepo->getTagsByIds($tagIds);

            if ($tags->count() > $maxCount) {
                return false;
            }

            return true;
        });
    }
}
