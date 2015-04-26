<?php namespace GSVnet\Users\Profiles;

use GSVnet\Users\Profiles\ProfileCreatorValidator;
use GSVnet\Users\Profiles\ProfileUpdatorValidator;

use GSVnet\Users\Profiles\ProfilesRepository;

use GSVnet\Users\UsersRepository;
use GSVnet\Users\User;

use GSVnet\Core\ImageHandler;
use GSVnet\Albums\Photos\PhotoStorageException;
use Event;


class ProfileManager
{
    protected $createValidator;
    protected $updateValidator;
    protected $profiles;
    protected $users;
    protected $imageHandler;

    public function __construct(
        ProfileCreatorValidator $createValidator,
        ProfileUpdatorValidator $updateValidator,
        ProfilesRepository $profiles,
        UsersRepository $users,
        ImageHandler $imageHandler)
    {
        $this->createValidator = $createValidator;
        $this->updateValidator = $updateValidator;
        $this->profiles = $profiles;
        $this->users = $users;
        $this->imageHandler = $imageHandler;
    }

    /**
     * Validate input, create user model and store user file
     *
     * @param User $user
     * @param array $input
     * @throws PhotoStorageException
     * @throws \GSVnet\Core\Exceptions\ValidationException
     * @return User
     */
    public function create(User $user, array $input)
    {
        $this->createValidator->validate($input);
        // If photo was uploaded, save it
        if (isset($input['photo_path']))
        {
            // Store photo and set it's new path in the input variable
            $this->uploadPhoto($input);
        }

        // Save the user to the database
        $profile = $this->profiles->create($user, $input);

        // Send email etc.
        Event::fire('potential.registered', [
            'user' => $user,
            'profile' => $profile,
            'input' => $input
        ]);

        return $profile;
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