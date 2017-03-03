<?php namespace GSVnet\Users\ProfileActions;

use GSVnet\Core\BaseRepository;
use GSVnet\Users\User;

class ProfileActionsRepository extends BaseRepository {

    function __construct(ProfileAction $model)
    {
        $this->model = $model;
    }

    public function latestUpdatesWithMembers()
    {
        return $this->model->with('user.profile.yearGroup')->orderBy('at', 'DESC')->simplePaginate(50);
    }

    public function latestUpdatesOfMember(User $user)
    {
        return $user->profileChanges()->orderBy('at', 'DESC')->get();
    }
}