<?php namespace GSVnet\Comments;

use GSVnet\Core\FormModel;

class ReplyForm extends FormModel
{
    protected $validationRules = [
        'body'  => 'required',
    ];
}