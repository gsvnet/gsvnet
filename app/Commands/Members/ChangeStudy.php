<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\ValueObjects\Study;
use GSVnet\Users\User;
use Illuminate\Http\Request;

class ChangeStudy extends Command {

    /**
     * @var User
     */
    public $user;
    public $study;

    function __construct(User $user, Study $study)
    {
        $this->user = $user;
        $this->study = $study;
    }

    static function fromForm(Request $request, User $user)
    {
        $address = new Study(
            $request->get('study'),
            $request->get('student_number')
        );

        return new self($user, $address);
    }
}