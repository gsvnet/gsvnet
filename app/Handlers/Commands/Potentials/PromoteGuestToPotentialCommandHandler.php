<?php namespace GSV\Handlers\Commands\Potentials;

use GSV\Commands\Potentials\PromoteGuestToPotentialCommand;
use GSV\Events\Potentials\PotentialSignedUp;
use GSVnet\Users\Profiles\UserProfile;
use GSVnet\Users\UsersRepository;

class PromoteGuestToPotentialCommandHandler {

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
            'type' => User::POTENTIAL
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
        ]);

        $user->profile()->save($profile);

        event(new PotentialSignedUp($user, $command->message, $command->school, $command->studyStartYear));
    }
}