<?php namespace App\Commands\User;

use App\Commands\Command;
use GSVnet\Core\ValueObjects\Name;
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
            $request->get('firstName'),
            $request->get('middleName'),
            $request->get('lastName')
        );
        return new self($user, $name);
    }
}