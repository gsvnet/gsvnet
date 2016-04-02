<?php namespace GSV\Handlers\Commands\Members;

use DomainException;
use GSV\Commands\Members\ChangeEmail;
use GSV\Events\Members\EmailWasChanged;
use GSVnet\Users\UsersRepository;
use Illuminate\Support\MessageBag;

class ChangeEmailHandler {

    private $users;

    public function __construct(UsersRepository $users){
        $this->users = $users;
    }

    public function handle(ChangeEmail $command)
    {
        $this->validateUniqueness($command);

        $command->user->email = $command->email->getEmail();
        $this->users->save($command->user);

        event(new EmailWasChanged($command->user));
    }

    private function validateUniqueness(ChangeEmail $command)
    {
        if($this->users->isEmailAddressTaken($command->email->getEmail(), $command->user->id))
        {
            throw new DomainException(new MessageBag([
                'email' => 'Emailadres al bezet'
            ]));
        }
    }
}