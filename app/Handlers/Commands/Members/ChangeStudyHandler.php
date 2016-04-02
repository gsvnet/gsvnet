<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeStudy;
use GSV\Events\Members\StudyWasChanged;
use GSVnet\Users\Profiles\ProfilesRepository;

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