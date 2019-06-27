<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeMembershipStatus;
use GSV\Commands\Members\ChangeParentsDetails;
use GSV\Events\Members\MembershipStatusWasChanged;
use GSVnet\Users\User;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\ValueObjects\OptionalAddress;
use GSVnet\Users\ValueObjects\OptionalEmail;
use GSVnet\Users\ValueObjects\OptionalPhoneNumber;

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
        $user = $command->user;
        $oldStatus = $user->type;

        $user->type = $command->status;
        $this->users->save($user);

        // We don't need to keep parents' details of former members.
        if ($user->type == User::FORMERMEMBER) {
            dispatch(
                new ChangeParentsDetails(
                    $user,
                    $command->manager,
                    new OptionalAddress(null, null, null),
                    new OptionalPhoneNumber(null),
                    new OptionalEmail(null)
                )
            );
        }

        event(new MembershipStatusWasChanged($command->user, $command->manager, $oldStatus));
    }
}