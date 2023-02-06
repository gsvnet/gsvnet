<?php namespace App\Http\Validators;

use App\Helpers\Core\Validator;
use Illuminate\Support\Facades\Validator as LaravelValidator;

class StartThreadValidator extends Validator {

    static $rules = [
        'body' => 'required',
        'subject' => 'required|min:3',
        'tags' => 'required|max_tags:3',
    ];

    public function beforeValidation()
    {
        LaravelValidator::extend('max_tags', function ($attribute, $tagIds, $params) {
            $maxCount = $params[0];

            if ($tagIds->count() > $maxCount) {
                return false;
            }

            return true;
        });

        return $this;
    }
}