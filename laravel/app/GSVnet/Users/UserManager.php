<?php namespace GSVnet\Users;

use GSVnet\Users\UserCreatorValidator;

use GSVnet\Users\UsersRepository;

class UserManager
{
    protected $createValidator;
    protected $users;

    public function __construct(
        UserCreatorValidator $createValidator,
        UsersRepository $users)
    {
        $this->createValidator = $createValidator;
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
        return $this->users->create($input);
    }
}