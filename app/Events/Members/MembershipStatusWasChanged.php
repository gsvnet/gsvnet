<?php namespace GSV\Events\Members;

use GSV\Helpers\Users\User;

class MembershipStatusWasChanged extends ProfileEvent
{

    private $oldStatus;

    public function __construct(User $user, User $manager, $oldStatus)
    {
        parent::__construct($user, $manager);
        $this->oldStatus = $oldStatus;
    }

    public function getOldStatus()
    {
        return $this->oldStatus;
    }
}