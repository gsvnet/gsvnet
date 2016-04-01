<?php namespace GSV\Http\Validators;

use GSVnet\Core\Validator;

class EditReplyValidator extends Validator {
    static $rules = [
        'replyId' => 'exists:forum_replies,id',
        'reply' => 'required'
    ];
}