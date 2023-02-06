<?php

namespace App\Handlers\Commands\Users;

use App\Commands\Users\ChangeEmail;
use App\Events\Members\MemberEmailWasChanged;
use App\Helpers\Core\Exceptions\ValidationException;
use App\Helpers\Users\UsersRepository;
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

        if ($command->user->isMemberOrReunist()) {
            event(new MemberEmailWasChanged($command->user, $command->manager, $oldEmail));
        }
    }

    private function validateUniqueness(ChangeEmail $command)
    {
        if ($this->users->isEmailAddressTaken($command->email->getEmail(), $command->user->id)) {
            throw new ValidationException(new MessageBag([
                'email' => 'Emailadres al bezet',
            ]));
        }
    }
}
