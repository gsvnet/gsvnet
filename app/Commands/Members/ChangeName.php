<?php namespace App\Commands\Members;

use App\Commands\Command;
use App\Helpers\Users\ValueObjects\Name;
use App\Helpers\Users\User;
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