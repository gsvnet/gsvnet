<?php

namespace App\Events\Members;

use App\Helpers\Users\User;

class MemberEmailWasChanged extends ProfileEvent
{
    protected $oldEmail;

    /**
     * MemberEmailWasChanged constructor.
     *
     * @param $oldEmail
     */
    public function __construct(User $member, User $manager, $oldEmail)
    {
        parent::__construct($member, $manager);
        $this->oldEmail = $oldEmail;
    }

    public function getOldEmail(): string
    {
        return $this->oldEmail;
    }
}
