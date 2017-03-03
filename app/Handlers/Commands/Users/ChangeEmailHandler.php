<?php namespace GSV\Handlers\Commands\Users;

use GSV\Commands\Users\ChangeEmail;
use GSV\Events\Members\MemberEmailWasChanged;
use GSVnet\Core\Exceptions\ValidationException;
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
            event(new MemberEmailWasChanged($command->user, $command->manager, $oldEmail));
        }
    }

    private function validateUniqueness(ChangeEmail $command)
    {
        if ($this->users->isEmailAddressTaken($command->email->getEmail(), $command->user->id)) {
            throw new ValidationException(new MessageBag([
                'email' => 'Emailadres al bezet'
            ]));
        }
    }
}