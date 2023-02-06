<?php namespace App\Helpers\Users\Profiles;

use App\Helpers\Users\UsersRepository;
use App\Helpers\Core\ImageHandler;
use App\Helpers\Albums\Photos\PhotoStorageException;
use Event;


class ProfileManager
{
    protected $createValidator;
    protected $updateValidator;
    protected $profiles;
    protected $users;
    protected $imageHandler;

    public function __construct(
        ProfileUpdatorValidator $updateValidator,
        ProfilesRepository $profiles,
        UsersRepository $users,
        ImageHandler $imageHandler)
    {
        $this->updateValidator = $updateValidator;
        $this->profiles = $profiles;
        $this->users = $users;
        $this->imageHandler = $imageHandler;
    }

    public function update($id, $input)
    {
        $this->updateValidator->validate($input);
        // Optionally update the photo's file
        if (isset($input['photo_path']))
        {
            // Delete the old photo file and store the new one
            $profile = $this->profiles->byId($id);

            // If uploading new photo, destroy old one and upload new photo
            $this->imageHandler->destroy($profile->photo_path);
            $this->uploadPhoto($input);
        }

        $profile = $this->profiles->update($id, $input);

        return $profile;
    }


    // Uploads a photo and adjust the input's src_path accordingly
    private function uploadPhoto(&$input)
    {
        if (! $input['photo_path'] = $this->imageHandler->make( $input['photo_path'],
            "/uploads/images/users/"))
        {
            throw new PhotoStorageException;
        }
    }
}