<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSV\Helpers\Users\ValueObjects\Name;
use GSV\Helpers\Users\User;
use Illuminate\Http\Request;

class ChangeName extends Command {

    /**
     * @var User
     */
    public $user;

    /**
     * @var user
     */
    public $manager;

    /**
     * @var Name
     */
    public $name;

    function __construct(User $user, User $manager, Name $name)
    {
        $this->user = $user;
        $this->name = $name;
        $this->manager = $manager;
    }

    static function fromForm(Request $request, User $user)
    {
        $name = new Name(
            $request->get('firstname'),
            $request->get('middlename'),
            $request->get('lastname'),
            $request->get('initials')
        );
        return new self($user, $request->user(), $name);
    }
}