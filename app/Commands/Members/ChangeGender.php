<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\Gender;
use Illuminate\Http\Request;

class ChangeGender extends Command {

    /**
     * @var User
     */
    public $user;
    public $gender;

    function __construct(User $user, Gender $gender)
    {
        $this->user = $user;
        $this->gender = $gender;
    }

    public static function fromForm(Request $request, User $user)
    {
        $gender = new Gender($request->get('gender', null));

        return new static($user, $gender);
    }
}