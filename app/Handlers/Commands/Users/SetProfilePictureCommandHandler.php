<?php namespace GSV\Handlers\Commands\Users;

use GSV\Commands\Users\SetProfilePictureCommand;
use GSV\Events\Members\ProfilePictureWasChanged;
use GSV\Helpers\Albums\Photos\PhotoStorageException;
use GSV\Helpers\Core\ImageHandler;

class SetProfilePictureCommandHandler
{

    private $imageHandler;

    public function __construct(ImageHandler $imageHandler)
    {
        $this->imageHandler = $imageHandler;
    }

    public function handle(SetProfilePictureCommand $command)
    {
        $profile = $command->user->profile;

        // If uploading new photo, destroy old one and upload new photo
        $this->imageHandler->destroy($profile->photo_path);

        if (!$path = $this->imageHandler->make($command->file, "/uploads/images/users/")) {
            throw new PhotoStorageException;
        }

        $profile->photo_path = $path;
        $profile->save();

        if ($command->user->isMemberOrReunist()) {
            event(new ProfilePictureWasChanged($command->user, $command->manager));
        }
    }
}