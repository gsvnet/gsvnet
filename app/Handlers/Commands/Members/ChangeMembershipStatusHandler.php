<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeMembershipStatus;
use GSV\Commands\Members\ChangeParentsDetails;
use GSV\Commands\Members\ForgetMember;
use GSV\Events\Members\MembershipStatusWasChanged;
use GSV\Helpers\Users\User;
use GSV\Helpers\Users\UsersRepository;
use GSV\Helpers\Users\Profiles\UserProfile;
use GSV\Helpers\Users\ValueObjects\OptionalAddress;
use GSV\Helpers\Users\ValueObjects\OptionalEmail;
use GSV\Helpers\Users\ValueObjects\OptionalPhoneNumber;

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

        /* Ensure the user has a profile if needed */
        if($user->wasOrIsMember() && !$command->user->profile) {
            $profile = new UserProfile();
            $user->profile()->save($profile);
            // Saving does not seem to refresh the property, so manually do so.
            $user->profile = $profile;
        }

        // We don't need to keep parents' details of reunists.
        if ($user->isReunist()) {
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

        // Remove even more user details when changing to ex-member
        if($user->isExMember()) {
            dispatch(
                new ForgetMember(
                    $user,
                    $command->manager,
                    false, // name
                    false, // username
                    true, // address
                    false, // email
                    true, // profilePicture
                    true, // birthday
                    true, // gender
                    true, // phone
                    true, // study
                    true, // business
                    true // parents
                )
            );
        }

        event(new MembershipStatusWasChanged($command->user, $command->manager, $oldStatus));
    }
}