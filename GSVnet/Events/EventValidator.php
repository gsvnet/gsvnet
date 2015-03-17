<?php namespace GSVnet\Events;

use GSVnet\Core\Validator;
use GSVnet\Core\Exceptions\ValidationException;

class EventValidator extends Validator
{
    static $rules = array(
        'title' => 'required',
        'meta_description' => 'required',
        'description' => 'required',
        'type' => 'required',
        'start_date' => 'required|date_format:Y-m-d',
        'end_date' => 'required|date_format:Y-m-d'
    );

    /**
     * Trigger validation
     *
     * @param array $data
     *
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data)
    {
        $validation = $this->validator->make($data, static::$rules);

        $validation->sometimes(['start_time'], ['required', 'regex:/^([01]?[0-9]|2[0-3]):([0-5][0-9])$/'], function($input){
            return $input->get('whole_day', '0') == '0';
        });

        if ( $validation->fails()) throw new ValidationException($validation->messages());

        return true;
    }
}