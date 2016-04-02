<?php namespace GSVnet\Users\ValueObjects;

use GSVnet\Core\ValueObject;

class Study extends ValueObject
{
    /**
     * @var string
     */
    protected $study;

    /**
     * @var string
     */
    protected $studentNumber;

    /**
     * Study constructor.
     * @param string $study
     * @param string $studentNumber
     */
    public function __construct($study, $studentNumber)
    {
        $this->study = trim($study);
        $this->studentNumber = strtolower(trim($studentNumber));
    }

    /**
     * @return string
     */
    public function getStudy()
    {
        return $this->study;
    }

    /**
     * @return string
     */
    public function getStudentNumber()
    {
        return $this->studentNumber;
    }
}