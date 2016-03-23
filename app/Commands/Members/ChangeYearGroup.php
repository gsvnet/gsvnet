<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use GSVnet\Users\YearGroup;

class ChangeYearGroup extends Command {

    /**
     * @var User
     */
    public $user;
    public $yearGroup;

    function __construct(User $user, YearGroup $yearGroup)
    {
        $this->user = $user;
        $this->yearGroup = $yearGroup;
    }
}