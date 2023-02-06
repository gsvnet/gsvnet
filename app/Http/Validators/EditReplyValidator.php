<?php namespace GSV\Http\Validators;

use GSV\Helpers\Core\Validator;

class EditReplyValidator extends Validator {
    static $rules = [
        'replyId' => 'exists:forum_replies,id',
        'reply' => 'required'
    ];
}