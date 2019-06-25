<?php

namespace GSV\Commands\Members;


use GSV\Commands\Command;
use GSV\Http\Requests\Request;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\Username;

class ChangeUsername extends Command {

    public $user;

    public $manager;

    public $username;

    function __construct(User $user, User $manager, Username $username)
    {
        $this->user = $user;
        $this->manager = $manager;
        $this->username = $username;
    }

    static function fromForm(Request $request, User $user)
    {
        return new self($user, $request->user(), new Username($request->get('username')));
    }
}