<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSV\Helpers\Users\User;
use GSV\Helpers\Users\ValueObjects\Address;
use GSV\Helpers\Users\ValueObjects\PhoneNumber;
use Illuminate\Http\Request;

class ChangePhone extends Command {

    /**
     * @var User
     */
    public $user;

    /**
     * @var user
     */
    public $manager;

    /**
     * @var PhoneNumber
     */
    public $phone;

    /**
     * ChangePhone constructor.
     * @param User $user
     * @param User $manager
     * @param PhoneNumber $phone
     */
    function __construct(User $user, User $manager, PhoneNumber $phone)
    {
        $this->user = $user;
        $this->phone = $phone;
        $this->manager = $manager;
    }

    static function fromForm(Request $request, User $user)
    {
        $address = new PhoneNumber(
            $request->get('phone')
        );

        return new self($user, $request->user(), $address);
    }
}