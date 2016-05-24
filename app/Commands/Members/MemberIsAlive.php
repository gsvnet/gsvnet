<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use Illuminate\Http\Request;

class MemberIsAlive extends Command {

    /**
     * @var User
     */
    public $user;

    /**
     * @var boolean
     */
    public $alive;

    /**
     * @var User
     */
    public $manager;

    /**
     * MemberIsAlive constructor.
     * @param User $user
     * @param User $manager
     * @param bool $alive
     */
    public function __construct(User $user, User $manager, bool $alive)
    {
        $this->user = $user;
        $this->alive = $alive;
        $this->manager = $manager;
    }

    static function fromForm(Request $request, User $user)
    {
        return new static($user, $request->user(), !! $request->get('alive'));
    }
}