<?php

namespace App\Helpers\Committees;

use App\Helpers\Core\Validator;

class CommitteeUpdaterValidator extends Validator
{
    public static $rules = [
        'id' => 'required|exists:committees,id',
        'name' => 'required',
        'description' => 'required',
        'unique_name' => 'required|unique:committees,unique_name',
    ];

    public function forCommittee($id)
    {
        self::$rules['unique_name'] = 'required|unique:committees,unique_name,'.$id;
    }
}
