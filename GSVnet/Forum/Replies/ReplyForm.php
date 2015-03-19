<?php namespace GSVnet\Forum\Replies;

use GSVnet\Core\FormModel;

class ReplyForm extends FormModel
{
    protected $validationRules = [
        'body'  => 'required',
    ];
}