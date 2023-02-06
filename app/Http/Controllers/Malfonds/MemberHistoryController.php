<?php namespace Malfonds;

use App\Helpers\Users\ProfileActions\ProfileActionsRepository;
use App\Helpers\Users\ProfileActions\ProfileActionsTransformer;
use App\Helpers\Users\UsersRepository;

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
        $this->authorize('users.show');
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $changes = $this->actions->latestUpdatesOfMember($member);
        
        return $this->withCollection($changes, new ProfileActionsTransformer);
    }
}