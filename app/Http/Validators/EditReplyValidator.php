<?php namespace GSV\Http\Requests;

use GSVnet\Core\Validator;

class EditReplyValidator extends Validator {
    static $rules = [
        'replyId' => 'exists:forum_replies,id',
        'reply' => 'required'
    ];
}