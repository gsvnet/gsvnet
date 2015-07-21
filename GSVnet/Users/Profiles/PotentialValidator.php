<?php namespace GSVnet\Users\Profiles;

use GSVnet\Core\Validator;

class PotentialValidator extends Validator
{
    static $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'gender' => 'required|in:0,1',
        'birthdate' => 'required|date_format:Y-m-d',
        'address' => 'required',
        'zipCode' => 'required',
        'town' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'studentNumber' => '',
        'study' => 'required',
        'username' => 'required',
        'password' => 'required|confirmed',
        'parentsAddress' => 'required_if:parents-same-address,0',
        'parentsZipCode' => 'required_if:parents-same-address,0',
        'parentsTown' => 'required_if:parents-same-address,0',
        'parentsPhone' => 'required'
    ];
}