<?php namespace GSVnet\Users\Profiles;

use GSVnet\Users\Profiles\ProfileCreatorValidator;
use GSVnet\Users\Profiles\ProfileUpdatorValidator;

use GSVnet\Users\Profiles\ProfilesRepository;

use GSVnet\Users\UsersRepository;
use GSVnet\Users\User;

use Event;


class ProfileManager
{
    protected $createValidator;
    protected $updateValidator;
    protected $profiles;
    protected $users;

    public function __construct(
        ProfileCreatorValidator $createValidator,
        ProfileUpdatorValidator $updateValidator,
        ProfilesRepository $profiles,
        UsersRepository $users)
    {
        $this->createValidator = $createValidator;
        $this->profiles = $profiles;
        $this->users = $users;
    }

    /**
    * Validate input, create user model and store user file
    *
    * @param array $input
    * @return User
    */
    public function create(User $user, array $input)
    {
        $this->createValidator->validate($input);
        // TODO: upload photo

        // Save the user to the database
        $profile = $this->profiles->create($user, $input);

        // Send email etc.
        Event::fire('potential.registered', ['user' => $user]);

        return $profile;
    }

    public function update($id, $input)
    {
        $this->updateValidator->validate($input);
        $profile = $this->profiles->byId($id);
        // If uploading new photo, destroy old one and upload new photo
        $this->photoManager->destroy($profile->photo_path);
        $input['photo_path'] = $this->photoManager->update($input['photo']);

        $profile = $this->profiles->update($id, $input);

        Event::fire('profile.updated', ['profile' => $profile]);

        return $profile;
    }
}