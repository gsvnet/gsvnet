<?php namespace App\Http\Validators;

use App\Helpers\Core\Validator;

class ReplyToThreadValidator extends Validator {
    static $rules = [
        'reply' => 'required',
        'threadSlug' => 'exists:forum_threads,slug'
    ];
}