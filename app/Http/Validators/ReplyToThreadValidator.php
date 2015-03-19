<?php namespace GSV\Http\Requests;

use GSVnet\Core\Validator;

class ReplyToThreadValidator extends Validator {
    static $rules = [
        'reply' => 'required',
        'threadSlug' => 'exists:forum_threads,slug'
    ];
}