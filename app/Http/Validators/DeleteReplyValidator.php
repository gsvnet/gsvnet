<?php namespace App\Http\Validators;

use App\Helpers\Core\Validator;

class DeleteReplyValidator extends Validator {
    static $rules = [
        'replyId' => 'exists:forum_replies,id'
    ];
}