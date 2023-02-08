<?php

namespace App\Commands\Members;

use App\Commands\Command;
use App\Helpers\Users\User;
use App\Helpers\Users\ValueObjects\Username;
use Illuminate\Http\Request;

class ChangeUsername extends Command
{
    public $user;

    public $manager;

    public $username;

    public function __construct(User $user, User $manager, Username $username)
    {
        $this->user = $user;
        $this->manager = $manager;
        $this->username = $username;
    }

    public static function fromForm(Request $request, User $user)
    {
        return new self($user, $request->user(), new Username($request->get('username')));
    }
}
