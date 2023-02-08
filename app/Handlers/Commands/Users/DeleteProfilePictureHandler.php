<?php

namespace App\Handlers\Commands\Users;

use App\Commands\Users\DeleteProfilePicture;
use App\Events\Members\ProfilePictureWasChanged;
use App\Helpers\Core\ImageHandler;

class DeleteProfilePictureHandler
{
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
