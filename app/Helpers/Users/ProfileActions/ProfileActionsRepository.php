<?php

namespace App\Helpers\Users\ProfileActions;

use App\Helpers\Core\BaseRepository;
use App\Helpers\Users\User;

class ProfileActionsRepository extends BaseRepository
{
    public function __construct(ProfileAction $model)
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
