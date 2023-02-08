<?php

namespace App\Commands\Members;

use App\Commands\Command;
use App\Helpers\Users\User;
use Illuminate\Database\Eloquent\Collection;

class ChangeRegion extends Command
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var Collection
     */
    public $regions;

    /**
     * @var user
     */
    public $manager;

    public function __construct(User $user, User $manager, Collection $regions)
    {
        $this->user = $user;
        $this->regions = $regions;
        $this->manager = $manager;
    }
}
