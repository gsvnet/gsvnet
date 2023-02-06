<?php namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangeMembershipStatus;
use App\Commands\Members\ChangeParentsDetails;
use App\Commands\Members\ForgetMember;
use App\Events\Members\MembershipStatusWasChanged;
use App\Helpers\Users\User;
use App\Helpers\Users\UsersRepository;
use App\Helpers\Users\Profiles\UserProfile;
use App\Helpers\Users\ValueObjects\OptionalAddress;
use App\Helpers\Users\ValueObjects\OptionalEmail;
use App\Helpers\Users\ValueObjects\OptionalPhoneNumber;

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