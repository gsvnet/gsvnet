<?php namespace App\Commands\Members;

use App\Commands\Command;
use App\Helpers\Users\User;
use App\Helpers\Users\ValueObjects\Gender;
use Illuminate\Http\Request;

class ChangeGender extends Command {

    /**
     * @var User
     */
    public $user;

    /**
     * @var Gender
     */
    public $gender;

    /**
     * @var user
     */
    public $manager;

    function __construct(User $user, User $manager, Gender $gender)
    {
        $this->user = $user;
        $this->gender = $gender;
        $this->manager = $manager;
    }

    public static function fromForm(Request $request, User $user)
    {
        $gender = new Gender($request->get('gender', null));

        return new static($user, $request->user(), $gender);
    }
}