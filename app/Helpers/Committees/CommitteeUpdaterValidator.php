<?php namespace GSV\Helpers\Committees;

use GSV\Helpers\Core\Validator;

class CommitteeUpdaterValidator extends Validator
{
    static $rules = array(
        'id'          => 'required|exists:committees,id',
        'name'        => 'required',
        'description' => 'required',
        'unique_name' => 'required|unique:committees,unique_name'
    );

    public function forCommittee($id)
    {
    	self::$rules['unique_name'] = 'required|unique:committees,unique_name,' . $id;
    }
}