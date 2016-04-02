<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\Address;
use Illuminate\Http\Request;

class ChangeAddress extends Command {

    /**
     * @var User
     */
    public $user;

    /**
     * @var User
     */
    public $manager;

    /**
     * @var Address
     */
    public $address;

    function __construct(User $user, User $manager, Address $address)
    {
        $this->manager = $user;
        $this->user = $user;
        $this->address = $address;
    }

    static function fromForm(Request $request, User $user)
    {
        $address = new Address(
            $request->get('address'),
            $request->get('zip_code'),
            $request->get('town'),
            $request->get('country')
        );

        return new self($user, $request->user(), $address);
    }
}