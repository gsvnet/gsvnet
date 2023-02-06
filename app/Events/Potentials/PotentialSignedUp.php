<?php namespace App\Events\Potentials;

use App\Events\Event;
use App\Helpers\Users\User;
use Illuminate\Queue\SerializesModels;

class PotentialSignedUp extends Event {

    use SerializesModels;

    public $user;
    public $message;
    public $school;
    public $startYear;
    public $parentsEmail;

    public function __construct(User $user, $message, $school, $startYear, $parentsEmail)
    {
        $this->user = $user;
        $this->message = $message;
        $this->school = $school;
        $this->startYear = $startYear;
        $this->parentsEmail = $parentsEmail;
    }
}