<?php

namespace App\Commands\Users;

use App\Commands\Command;
use App\Helpers\Users\User;
use App\Helpers\Users\ValueObjects\Email;
use Illuminate\Http\Request;

class ChangeEmail extends Command
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var User
     */
    public $manager;

    /**
     * @var Email
     */
    public $email;

    /**
     * ChangeEmail constructor.
     *
     * @param  User  $user
     * @param  User  $manager
     * @param  Email  $email
     */
    public function __construct(User $user, User $manager, Email $email)
    {
        $this->email = $email;
        $this->user = $user;
        $this->manager = $manager;
    }

    public static function fromForm(Request $request, User $user)
    {
        $email = new Email($request->get('email'));

        return new self($user, $request->user(), $email);
    }
}
