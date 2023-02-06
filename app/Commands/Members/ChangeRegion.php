<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSV\Helpers\Users\User;
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

    function __construct(User $user, User $manager, Collection $regions)
    {
        $this->user = $user;
        $this->regions = $regions;
        $this->manager = $manager;
    }
}