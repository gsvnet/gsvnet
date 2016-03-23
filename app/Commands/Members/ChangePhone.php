<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\Address;
use GSVnet\Users\ValueObjects\PhoneNumber;
use Illuminate\Http\Request;

class ChangePhone extends Command {

    /**
     * @var User
     */
    public $user;
    public $phone;

    function __construct(User $user, PhoneNumber $phone)
    {
        $this->user = $user;
        $this->phone = $phone;
    }

    static function fromForm(Request $request, User $user)
    {
        $address = new PhoneNumber(
            $request->get('phone')
        );

        return new self($user, $address);
    }
}