<?php namespace App\Handlers\Events\Members;

use App\Events\Members\ProfileEvent;
use App\Helpers\Users\ProfileActions\ProfileAction;
use App\Helpers\Users\ProfileActions\ProfileActionsRepository;
use App\Helpers\Users\UsersRepository;

class ProfileUpdates
{
    function __construct(ProfileActionsRepository $actions, UsersRepository $users)
    {
        $this->actions = $actions;
        $this->users = $users;
    }

    public function changedProfile(ProfileEvent $event)
    {
        $name = get_class($event);
        $action = ProfileAction::createForUser(
            $event->getUser()->id,
            $event->getAt(),
            $name
        );
        $this->actions->save($action);
    }

    public function tookAccountInUse(ProfileEvent $event)
    {
        $member = $event->getUser();
        $member->verified = true;
        $this->users->save($member);
    }
}