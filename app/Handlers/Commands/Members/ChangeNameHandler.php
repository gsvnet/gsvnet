<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeName;
use GSV\Events\Members\NameWasChanged;
use GSVnet\Users\UsersRepository;

class ChangeNameHandler {

    public function __construct(UsersRepository $users){
        $this->users = $users;
    }

    public function handle(ChangeName $command)
    {
        
        $command->user->firstname = $command->name->getFirstName();
        $command->user->middlename = $command->name->getMiddleName();
        $command->user->lastname = $command->name->getLastName();

        $this->users->save($command->user);

        event(new NameWasChanged($command->user));
    }
}