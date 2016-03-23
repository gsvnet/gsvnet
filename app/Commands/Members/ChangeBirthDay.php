<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\Date;
use Illuminate\Http\Request;

class ChangeBirthDay extends Command {

    public $user;
    public $birthday;

    function __construct(User $user, Date $birthday)
    {
        $this->user = $user;
        $this->birthday = $birthday;
    }

    static function fromForm(Request $request, User $user)
    {
        $birthday = new Date($request->get('birthdate'));

        return new static($user, $birthday);
    }
}