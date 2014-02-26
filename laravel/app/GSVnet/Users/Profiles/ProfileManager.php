<?php namespace GSVnet\Users\Profiles;

use GSVnet\Users\Profiles\ProfileCreatorValidator;
use GSVnet\Users\Profiles\ProfilesRepository;

use GSVnet\Users\UsersRepository;
use GSVnet\Users\User;


class ProfileManager
{
    protected $createValidator;
    protected $profiles;
    protected $users;

    public function __construct(
        ProfileCreatorValidator $createValidator,
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
}