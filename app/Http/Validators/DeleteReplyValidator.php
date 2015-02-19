<?php namespace GSV\Http\Requests;

use GSVnet\Core\Validator;

class DeleteReplyValidator extends Validator {
    static $rules = [
        'replyId' => 'exists:forum_replies,id'
    ];
}