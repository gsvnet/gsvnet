<?php namespace GSVnet\Users\Profiles;

use GSVnet\Core\Validator;

class ProfileCreatorValidator extends Validator
{
    static $rules = [
            'potential-image' => 'image',
            'potential-address' => 'required',
            'potential-zip-code' => 'required',
            'potential-town' => 'required',
            'potential-phone' => 'required',
            'potential-gender' => 'required|in:0,1',
            'potential-birthdate' => 'required|date_format:Y-m-d',
            'potential-church' => 'required',
            'potential-student-number' => '',
            'potential-study' => 'required',
            'parents-address' => 'required_if:parents-same-address,0',
            'parents-zip-code' => 'required_if:parents-same-address,0',
            'parents-town' => 'required_if:parents-same-address,0',
            'parents-email' => 'required|email',
            'parents-phone' => 'required',

            'photo_path' => 'image',
    ];
}