<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\Date;
use Illuminate\Http\Request;

class ChangeBirthDay extends Command {

    /**
     * @var User
     */
    public $user;
    
    /**
     * @var User
     */
    public $manager;

    /**
     * @var Date
     */
    public $birthday;

    /**
     * ChangeBirthDay constructor.
     * @param User $user
     * @param User $manager
     * @param Date $birthday
     */
    function __construct(User $user, User $manager, Date $birthday)
    {
        $this->user = $user;
        $this->birthday = $birthday;
        $this->manager = $manager;
    }

    static function fromForm(Request $request, User $user)
    {
        $birthday = new Date($request->get('birthdate'));

        return new static($user, $request->user(), $birthday);
    }
}