<?php

namespace App\Commands\Members;

use App\Commands\Command;
use App\Helpers\Users\User;
use App\Helpers\Users\ValueObjects\Study;
use Illuminate\Http\Request;

class ChangeStudy extends Command
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var Study
     */
    public $study;

    /**
     * @var user
     */
    public $manager;

    /**
     * ChangeStudy constructor.
     *
     * @param  User  $user
     * @param  User  $manager
     * @param  Study  $study
     */
    public function __construct(User $user, User $manager, Study $study)
    {
        $this->user = $user;
        $this->study = $study;
        $this->manager = $manager;
    }

    public static function fromForm(Request $request, User $user)
    {
        $address = new Study(
            $request->get('study'),
            $request->get('student_number')
        );

        return new self($user, $request->user(), $address);
    }
}
