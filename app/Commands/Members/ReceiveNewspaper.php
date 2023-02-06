<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSV\Helpers\Users\User;
use Illuminate\Http\Request;

class ReceiveNewspaper extends Command {

    /**
     * @var User
     */
    public $user;

    /**
     * @var boolean
     */
    public $receive_newspaper;

    /**
     * @var User
     */
    public $manager;

    /**
     * ReceiveNewspaper constructor.
     * @param User $user
     * @param User $manager
     * @param bool $receive_newspaper
     */
    public function __construct(User $user, User $manager, bool $receive_newspaper)
    {
        $this->user = $user;
        $this->receive_newspaper = $receive_newspaper;
        $this->manager = $manager;
    }

    static function fromForm(Request $request, User $user)
    {
        return new static($user, $request->user(), !! $request->get('receive_newspaper'));
    }
}