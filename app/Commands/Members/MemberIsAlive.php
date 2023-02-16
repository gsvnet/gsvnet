<?php

namespace App\Commands\Members;

use App\Commands\Command;
use App\Helpers\Users\User;
use Illuminate\Http\Request;

class MemberIsAlive extends Command
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var bool
     */
    public $alive;

    /**
     * @var User
     */
    public $manager;

    /**
     * MemberIsAlive constructor.
     */
    public function __construct(User $user, User $manager, bool $alive)
    {
        $this->user = $user;
        $this->alive = $alive;
        $this->manager = $manager;
    }

    public static function fromForm(Request $request, User $user)
    {
        return new static($user, $request->user(), (bool) $request->get('alive'));
    }
}
