<?php namespace GSV\Commands\Users;

use GSV\Commands\Command;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\Email;
use Illuminate\Http\Request;

class ChangeEmail extends Command {

    /**
     * @var User
     */
    public $user;
    public $email;

    function __construct(User $user, Email $email)
    {
        $this->email = $email;
        $this->user = $user;
    }

    static function fromForm(Request $request, User $user)
    {
        $email = new Email($request->get('email'));
        return new self($user, $email);
    }
}