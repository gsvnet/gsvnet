<?php namespace GSV\Handlers\Commands\Potentials;

use GSV\Commands\Potentials\SignUpAsPotentialCommand;
use GSV\Events\Potentials\PotentialSignedUp;
use GSV\Helpers\Users\Profiles\UserProfile;
use GSV\Helpers\Users\User;
use GSV\Helpers\Users\UsersRepository;

class SignUpAsPotentialCommandHandler {

    private $users;

    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function handle(SignUpAsPotentialCommand $command)
    {
        $user = new User([
            'username' => $command->username,
            'firstname' => $command->firstname,
            'middlename' => $command->middlename,
            'lastname' => $command->lastname,
            'email' => $command->email,
            'password' => bcrypt($command->password),
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
            'parent_email' => $command->parentsEmail
        ]);

        $user->profile()->save($profile);

        event(new PotentialSignedUp($user, $command->message, $command->school, $command->studyStartYear, $command->parentsEmail));

        return $user;
    }
}