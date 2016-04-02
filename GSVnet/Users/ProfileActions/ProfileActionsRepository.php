<?php namespace GSVnet\Users\ProfileActions;

use GSVnet\Core\BaseRepository;

class ProfileActionsRepository extends BaseRepository {

    function __construct(ProfileAction $model)
    {
        $this->model = $model;
    }

    public function latestUpdatesWithMembers()
    {
        return $this->model->with('user.profile.yearGroup')->orderBy('at', 'DESC')->simplePaginate(50);
    }
}