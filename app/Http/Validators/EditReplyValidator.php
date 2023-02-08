<?php

namespace App\Http\Validators;

use App\Helpers\Core\Validator;

class EditReplyValidator extends Validator
{
    public static $rules = [
        'replyId' => 'exists:forum_replies,id',
        'reply' => 'required',
    ];
}
