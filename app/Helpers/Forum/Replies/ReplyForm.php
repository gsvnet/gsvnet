<?php

namespace App\Helpers\Forum\Replies;

use App\Helpers\Core\FormModel;

class ReplyForm extends FormModel
{
    protected $validationRules = [
        'body' => 'required',
    ];
}
