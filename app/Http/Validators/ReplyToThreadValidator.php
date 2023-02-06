<?php namespace GSV\Http\Validators;

use GSV\Helpers\Core\Validator;

class ReplyToThreadValidator extends Validator {
    static $rules = [
        'reply' => 'required',
        'threadSlug' => 'exists:forum_threads,slug'
    ];
}