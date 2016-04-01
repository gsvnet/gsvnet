<?php namespace GSV\Events\Users;

use GSV\Events\Event;
use GSVnet\Users\User;
use Illuminate\Queue\SerializesModels;

class UserWasRegistered extends Event  {

    use SerializesModels;

    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }
}