<?php namespace App\Commands\Users;

use App\Commands\Command;
use App\Helpers\Users\User;
use App\Helpers\Users\ValueObjects\Password;
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