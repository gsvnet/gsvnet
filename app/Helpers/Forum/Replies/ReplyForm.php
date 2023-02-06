<?php namespace GSV\Helpers\Forum\Replies;

use GSV\Helpers\Core\FormModel;

class ReplyForm extends FormModel
{
    protected $validationRules = [
        'body'  => 'required',
    ];
}