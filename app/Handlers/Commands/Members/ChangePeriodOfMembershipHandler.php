<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangePeriodOfMembership;
use GSV\Events\Members\PeriodOfMembershipWasChanged;
use GSV\Helpers\Users\Profiles\ProfilesRepository;

class ChangePeriodOfMembershipHandler
{
    /**
     * @var ProfilesRepository
     */
    private $profiles;

    /**
     * ChangePeriodOfMembershipHandler constructor.
     * @param ProfilesRepository $profiles
     */
    public function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangePeriodOfMembership $command)
    {
        $profile = $command->getUser()->profile;

        $profile->inauguration_date = $command->getInauguration()->asString();
        $profile->resignation_date = $command->getResignation()->asString();

        $this->profiles->save($profile);

        event(new PeriodOfMembershipWasChanged($command->getUser(), $command->getManager()));
    }
}