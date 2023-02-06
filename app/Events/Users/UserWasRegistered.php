<?php namespace App\Events\Users;

use App\Events\Event;
use App\Helpers\Users\User;
use Illuminate\Queue\SerializesModels;

class UserWasRegistered extends Event  {

    use SerializesModels;

    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }
}