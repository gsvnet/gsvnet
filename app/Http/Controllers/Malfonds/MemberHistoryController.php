<?php namespace Malfonds;

use GSVnet\Users\ProfileActions\ProfileActionsRepository;
use GSVnet\Users\ProfileActions\ProfileActionsTransformer;
use GSVnet\Users\UsersRepository;

class MemberHistoryController extends CoreApiController
{
    /**
     * @var ProfileActionsRepository
     */
    protected $actions;

    /**
     * @var UsersRepository
     */
    protected $users;

    /**
     * MemberHistoryController constructor.
     * @param ProfileActionsRepository $actions
     * @param UsersRepository $users
     */
    public function __construct(ProfileActionsRepository $actions, UsersRepository $users)
    {
        $this->actions = $actions;
        $this->users = $users;
    }

    public function show($id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $changes = $this->actions->latestUpdatesOfMember($member);
        
        return $this->withCollection($changes, new ProfileActionsTransformer);
    }
}