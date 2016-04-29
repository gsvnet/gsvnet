<?php namespace GSVnet\Users\ProfileActions;

use GSVnet\BaseTransformer;

class ProfileActionsTransformer extends BaseTransformer
{

    public function transform(ProfileAction $action)
    {
        return [
            'at' => $action->at->toIso8601String(),
            'user_id' => $action->user_id,
            'action' => $action->action
        ];
    }
}