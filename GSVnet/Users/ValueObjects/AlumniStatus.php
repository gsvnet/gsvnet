<?php namespace GSVnet\Users\ValueObjects;

use GSVnet\Core\ValueObject;

class AlumniStatus extends ValueObject
{
    protected $alumni;

    /**
     * AlumniStatus constructor.
     * @param $status
     */
    public function __construct($status)
    {
        $this->alumni = (bool) $status;
    }

    /**
     * @return boolean
     */
    public function isAlumni()
    {
        return $this->alumni;
    }
}