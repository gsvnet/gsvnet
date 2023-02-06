<?php

namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangeStudy;
use App\Events\Members\StudyWasChanged;
use App\Helpers\Users\Profiles\ProfilesRepository;

class ChangeStudyHandler
{
    private $profiles;

    public function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangeStudy $command)
    {
        $profile = $command->user->profile;

        $profile->study = $command->study->getStudy();
        $profile->student_number = $command->study->getStudentNumber();

        $this->profiles->save($profile);

        event(new StudyWasChanged($command->user, $command->manager));
    }
}
