<?php namespace GSV\Commands\Users;

use GSV\Commands\Command;
use GSV\Helpers\Users\User;
use GSV\Helpers\Users\ValueObjects\Email;
use Illuminate\Http\Request;

class ChangeEmail extends Command {

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
     * @param User $user
     * @param User $manager
     * @param Email $email
     */
    function __construct(User $user, User $manager, Email $email)
    {
        $this->email = $email;
        $this->user = $user;
        $this->manager = $manager;
    }

    static function fromForm(Request $request, User $user)
    {
        $email = new Email($request->get('email'));
        return new self($user, $request->user(), $email);
    }
}