<?php namespace GSV\Helpers\Users\ValueObjects;

use GSV\Helpers\Core\ValueObject;

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