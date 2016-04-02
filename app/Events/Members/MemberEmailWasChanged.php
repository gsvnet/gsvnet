<?php namespace GSV\Events\Members;

use GSVnet\Users\User;

class MemberEmailWasChanged extends ProfileEvent
{
    protected $oldEmail;

    /**
     * MemberEmailWasChanged constructor.
     * @param User $member
     * @param $oldEmail
     */
    public function __construct(User $member, $oldEmail)
    {
        parent::__construct($member);        
        $this->oldEmail = $oldEmail;
    }

    /**
     * @return string
     */
    public function getOldEmail()
    {
        return $this->oldEmail;
    }
}
