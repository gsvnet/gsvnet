<?php namespace GSV\Handlers\Commands\Users;

use DomainException;
use GSV\Commands\Users\ChangeEmail;
use GSV\Events\Members\MemberEmailWasChanged;
use GSVnet\Users\UsersRepository;
use Illuminate\Support\MessageBag;

class ChangeEmailHandler
{
    private $users;

    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function handle(ChangeEmail $command)
    {
        $this->validateUniqueness($command);

        $oldEmail = $command->user->email;

        $command->user->email = $command->email->getEmail();
        $this->users->save($command->user);

        if ($command->user->wasOrIsMember()) {
            event(new MemberEmailWasChanged($command->user, $oldEmail));
        }
    }

    private function validateUniqueness(ChangeEmail $command)
    {
        if ($this->users->isEmailAddressTaken($command->email->getEmail(), $command->user->id)) {
            throw new DomainException(new MessageBag([
                'email' => 'Emailadres al bezet'
            ]));
        }
    }
}