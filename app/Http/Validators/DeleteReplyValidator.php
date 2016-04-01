<?php namespace GSV\Http\Validators;

use GSVnet\Core\Validator;

class DeleteReplyValidator extends Validator {
    static $rules = [
        'replyId' => 'exists:forum_replies,id'
    ];
}