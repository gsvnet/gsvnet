<?php namespace GSV\Commands\Members;
use GSV\Commands\Command;
use GSV\Helpers\Users\User;

class ChangeMembershipStatus extends Command
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var int
     */
    public $status;

    /**
     * @var User
     */
    public $manager;

    /**
     * ChangeMembershipStatus constructor.
     * @param int $status Assumed to be in valid state!
     * @param User $user
     * @param User $manager
     */
    function __construct($status, User $user, User $manager)
    {
        $this->status = $status;
        $this->user = $user;
        $this->manager = $manager;
    }
}