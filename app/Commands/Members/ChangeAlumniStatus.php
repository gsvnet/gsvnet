<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\AlumniStatus;
use Illuminate\Http\Request;

class ChangeAlumniStatus extends Command
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
     * @var AlumniStatus
     */
    public $status;

    /**
     * ChangeAlumniStatus constructor.
     * @param User $user
     * @param User $manager
     * @param AlumniStatus $status
     */
    public function __construct(User $user, User $manager, AlumniStatus $status)
    {
        $this->user = $user;
        $this->status = $status;
        $this->manager = $manager;
    }

    public static function fromForm(Request $request, User $user)
    {
        $status = new AlumniStatus($request->get('reunist') === '1');
        return new static($user, $request->user(), $status);
    }
}