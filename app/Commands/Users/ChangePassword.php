<?php namespace GSV\Commands\Users;

use GSV\Commands\Command;
use GSV\Helpers\Users\User;
use GSV\Helpers\Users\ValueObjects\Password;
use Illuminate\Http\Request;

class ChangePassword extends Command {

    /**
     * @var User
     */
    public $user;
    public $password;

    public function __construct(User $user, Password $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public static function fromForm(Request $request, User $user)
    {
        $password = new Password($request->get('password'));
        return new static($user, $password);
    }
}