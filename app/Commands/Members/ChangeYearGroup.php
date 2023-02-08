<?php

namespace App\Commands\Members;

use App\Commands\Command;
use App\Helpers\Users\User;
use App\Helpers\Users\YearGroup;

class ChangeYearGroup extends Command
{
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

    public function __construct(User $user, User $manager, YearGroup $yearGroup)
    {
        $this->user = $user;
        $this->yearGroup = $yearGroup;
        $this->manager = $manager;
    }
}
