<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSV\Helpers\Users\User;
use GSV\Helpers\Users\YearGroup;

class ChangeYearGroup extends Command {

    /**
     * @var User
     */
    public $user;

    /**
     * @var YearGroup
     */
    public $yearGroup;

    /**
     * @var user
     */
    public $manager;

    function __construct(User $user, User $manager, YearGroup $yearGroup)
    {
        $this->user = $user;
        $this->yearGroup = $yearGroup;
        $this->manager = $manager;
    }
}