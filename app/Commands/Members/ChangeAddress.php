<?php

namespace App\Commands\Members;

use App\Commands\Command;
use App\Helpers\Users\User;
use App\Helpers\Users\ValueObjects\Address;
use Illuminate\Http\Request;

class ChangeAddress extends Command
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
     * @var Address
     */
    public $address;

    public function __construct(User $user, User $manager, Address $address)
    {
        $this->manager = $user;
        $this->user = $user;
        $this->address = $address;
    }

    public static function fromForm(Request $request, User $user)
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
