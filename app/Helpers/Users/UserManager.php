<?php

namespace App\Helpers\Users;

class UserManager
{
    protected $createValidator;

    protected $updateValidator;

    protected $users;

    public function __construct(UserCreatorValidator $createValidator, UserUpdatorValidator $updateValidator, UsersRepository $users)
    {
        $this->createValidator = $createValidator;
        $this->updateValidator = $updateValidator;
        $this->users = $users;
    }

    /**
     * Validate input, create user model and store user file
     */
    public function create(array $input): User
    {
        $this->createValidator->validate($input);
        $user = $this->users->create($input);

        // Send email etc.
        event('user.registered', ['user' => $user]);

        return $user;
    }

    public function activateUser($id)
    {
        $user = $this->users->byId($id);
        $this->users->activateUser($id);

        event('user.activated', ['user' => $user]);

        return $user;
    }

    /**
     *   Activates user and sends mail
     */
    public function acceptMembership($id)
    {
        $user = $this->users->byId($id);
        $this->users->acceptMembership($id);

        event('potential.accepted', ['user' => $user]);

        return $user;
    }
}
