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
     * @var AlumniStatus
     */
    public $status;

    /**
     * ChangeAlumniStatus constructor.
     * @param User $user
     * @param AlumniStatus $status
     */
    public function __construct(User $user, AlumniStatus $status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    public static function fromForm(Request $request, User $user)
    {
        $status = new AlumniStatus($request->get('reunist') === '1');
        return new static($user, $status);
    }
}