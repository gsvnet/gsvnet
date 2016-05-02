<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeMembershipStatus;
use GSV\Events\Members\MembershipStatusWasChanged;
use GSVnet\Users\UsersRepository;

class ChangeMembershipStatusHandler
{
    /**
     * @var UsersRepository
     */
    protected $users;

    /**
     * ChangeMembershipStatusHandler constructor.
     * @param UsersRepository $users
     */
    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function handle(ChangeMembershipStatus $command)
    {
        $command->user->type = $command->status;
        $this->users->save($command->user);

        event(new MembershipStatusWasChanged($command->user, $command->manager));
    }
}