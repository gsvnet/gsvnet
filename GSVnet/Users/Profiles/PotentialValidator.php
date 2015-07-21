<?php namespace GSVnet\Users\Profiles;

use GSVnet\Core\Validator;

class PotentialValidator extends Validator
{
    static $rules = [
        'firstname' => 'required',
        'middlename' => 'required',
        'lastname' => 'required',
        'gender' => 'required|in:0,1',
        'birthdate' => 'required|date_format:Y-m-d',
        'address' => 'required',
        'zip-code' => 'required',
        'town' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'student-number' => '',
        'study' => 'required',
        'username' => 'required',
        'password' => 'required',
        'parents-address' => 'required_if:parents-same-address,0',
        'parents-zip-code' => 'required_if:parents-same-address,0',
        'parents-town' => 'required_if:parents-same-address,0',
        'parents-email' => 'required|email',
        'parents-phone' => 'required'
    ];
}