<?php namespace GSV\Events\Potentials;

use GSVnet\Events\Event;
use GSVnet\Users\User;
use Illuminate\Queue\SerializesModels;

class PotentialSignedUp extends Event {

    use SerializesModels;

    public $user;
    public $message;
    public $school;
    public $startYear;

    public function __construct(User $user, $message, $school, $startYear)
    {
        $this->user = $user;
        $this->message = $message;
        $this->school = $school;
        $this->startYear = $startYear;
    }
}