<?php namespace GSVnet\Senates;

use GSVnet\Core\Validator;

class SenateValidator extends Validator
{
    static $rules = array(
        'name'        => 'required',
        'start_date'  => 'required,date',
        'end_date'    => 'required,date'
    );
}