<?php namespace GSV\Http\Validators;

use GSVnet\Core\Validator;

class ReplyToThreadValidator extends Validator {
    static $rules = [
        'reply' => 'required',
        'threadSlug' => 'exists:forum_threads,slug'
    ];
}