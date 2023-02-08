<?php

namespace App\Helpers\Users;

use Event;

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
     *
     * @param  array  $input
     * @return User
     */
    public function create(array $input)
    {
        $this->createValidator->validate($input);
        $user = $this->users->create($input);

        // Send email etc.
        Event::fire('user.registered', ['user' => $user]);

        return $user;
    }

    public function activateUser($id)
    {
        $user = $this->users->byId($id);
        $this->users->activateUser($id);

        Event::fire('user.activated', ['user' => $user]);

        return $user;
    }

    /**
     *   Activates user and sends mail
     */
    public function acceptMembership($id)
    {
        $user = $this->users->byId($id);
        $this->users->acceptMembership($id);

        Event::fire('potential.accepted', ['user' => $user]);

        return $user;
    }
}
