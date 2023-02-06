<?php namespace App\Helpers\Users\Profiles;

use App\Helpers\Core\Validator;

class ProfileUpdatorValidator extends Validator
{
    static $rules = [
        'photo_path' => 'image',
        'study' => 'required',
        'address' => 'required',
        'zip_code' => 'required',
        'town' => 'required',
        'phone' => 'required',
        'gender' => 'required|in:0,1',
        'initials' => 'required',
        'birthdate' => 'date',
        'parent_address' => 'required_if:parent_same_address,0',
        'parent_zip_code' => 'required_if:parent_same_address,0',
        'parent_town' => 'required_if:parent_same_address,0',
        'parent_phone' => 'required'
    ];
}