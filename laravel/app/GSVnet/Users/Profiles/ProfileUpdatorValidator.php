<?php namespace GSVnet\Users\Profiles;

use GSVnet\Core\Validator;

class ProfileUpdatorValidator extends Validator
{
    static $rules = [
            'photo' => 'image',
            'church' => 'required',
            'study' => 'required',
            'address' => 'required',
            'zip_code' => 'required',
            'town' => 'required',
            'phone' => 'required',
            'gender' => 'required|in:male,female',
            // 'study-year' => 'required|date_format:Y',
            'parent_address' => 'required_if:parent_same_address,0',
            'parent_zip_code' => 'required_if:parent_same_address,0',
            'parent_town' => 'required_if:parent_same_address,0',
            'parent_phone' => 'required'
    ];
}