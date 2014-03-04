<?php namespace GSVnet\Events;

use GSVnet\Core\Validator;

class EventValidator extends Validator
{
    static $rules = array(
        'title' => 'required',
        'description' => 'required',
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

        $validation->sometimes(array('start_time'), 'required', function($input){
            return $input->get('whole_day', '0') == '0';
        });

        if ( $validation->fails()) throw new ValidationException($validation->messages());

        return true;
    }
}