<?php namespace GSVnet\Users;

use Event;

use GSVnet\Users\UserCreatorValidator;

use GSVnet\Users\UsersRepository;

class UserManager
{
    protected $createValidator;
    protected $updateValidator;
    protected $users;

    public function __construct(
        UserCreatorValidator $createValidator,
        UserUpdatorValidator $updateValidator,
        UsersRepository $users)
    {
        $this->createValidator = $createValidator;
        $this->updateValidator = $updateValidator;
        $this->users = $users;
    }

    /**
    * Validate input, create user model and store user file
    *
    * @param array $input
    * @return User
    */
    public function create(array $input)
    {
        $this->createValidator->validate($input);
        // Save the user to the database
        $user = $this->users->create($input);

        // Send email etc.
        Event::fire('user.regitered');

        return $user;
    }

    public function update($id, array $input)
    {
        $this->updateValidator->validate($input);
        // Save new properties
        $user = $this->users->update($id, $input);
        return $user;
    }
}