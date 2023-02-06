<?php

namespace App\Handlers\Commands\Potentials;

use App\Commands\Potentials\PromoteGuestToPotentialCommand;
use App\Events\Potentials\PotentialSignedUp;
use App\Helpers\Users\Profiles\UserProfile;
use App\Helpers\Users\User;
use App\Helpers\Users\UsersRepository;

class PromoteGuestToPotentialCommandHandler
{
    private $users;

    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function handle(PromoteGuestToPotentialCommand $command)
    {
        $user = $this->users->byId($command->userId);
        $user->fill([
            'username' => $command->username,
            'firstname' => $command->firstname,
            'middlename' => $command->middlename,
            'lastname' => $command->lastname,
            'type' => User::POTENTIAL,
        ]);

        $this->users->save($user);

        $profile = new UserProfile([
            'phone' => $command->phone,
            'address' => $command->address,
            'zip_code' => $command->zipCode,
            'town' => $command->town,
            'study' => $command->study,
            'student_number' => $command->studentNumber,
            'birthdate' => $command->birthdate,
            'gender' => $command->gender,
            'reunist' => false,
            'parent_address' => $command->parentsAddress,
            'parent_zip_code' => $command->parentsZipCode,
            'parent_town' => $command->parentsTown,
            'parent_phone' => $command->parentsPhone,
            'parent_email' => $command->parentsEmail,
        ]);

        $user->profile()->save($profile);

        event(new PotentialSignedUp($user, $command->message, $command->school, $command->studyStartYear, $command->parentsEmail));
    }
}
