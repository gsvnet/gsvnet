<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\ValueObjects\Name;
use GSVnet\Users\User;
use Illuminate\Http\Request;

class ChangeName extends Command {

    public $user;
    public $name;

    function __construct(User $user, Name $name)
    {
        $this->user = $user;
        $this->name = $name;
    }

    static function fromForm(Request $request, User $user)
    {
        $name = new Name(
            $request->get('firstname'),
            $request->get('middlename'),
            $request->get('lastname'),
            $request->get('initials')
        );
        return new self($user, $name);
    }
}