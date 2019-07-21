<?php

namespace GSV\Handlers\Commands\Users;


use GSV\Commands\Users\DeleteProfilePicture;
use GSV\Events\Members\ProfilePictureWasChanged;
use GSVnet\Core\ImageHandler;

class DeleteProfilePictureHandler {

    private $imageHandler;

    public function __construct(ImageHandler $imageHandler)
    {
        $this->imageHandler = $imageHandler;
    }

    public function handle(DeleteProfilePicture $command)
    {
        $profile = $command->user->profile;
        $this->imageHandler->destroy($profile->photo_path);
        $profile->photo_path = null;
        $profile->save();

        if ($command->user->isMemberOrReunist()) {
            event(new ProfilePictureWasChanged($command->user, $command->manager));
        }
    }
}