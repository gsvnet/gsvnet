<?php namespace GSV\Helpers\Forum\Threads;

use GSV\Helpers\Core\FormModel;
use App, Validator;

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

            $tagRepo = App::make('GSV\Helpers\Tags\TagRepository');
            $tags = $tagRepo->getTagsByIds($tagIds);

            if ($tags->count() > $maxCount) {
                return false;
            }

            return true;
        });
    }
}
