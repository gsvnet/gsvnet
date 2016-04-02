<?php namespace GSV\Handlers\Events\Members;

use GSV\Events\Members\ProfileEvent;
use GSVnet\Users\ProfileActions\ProfileAction;
use GSVnet\Users\ProfileActions\ProfileActionsRepository;
use GSVnet\Users\UsersRepository;

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
}