<?php

namespace App\Commands\Members;

use App\Commands\Command;
use App\Helpers\Users\User;
use App\Helpers\Users\ValueObjects\PhoneNumber;
use Illuminate\Http\Request;

class ChangePhone extends Command
{
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
     *
     * @param  User  $user
     * @param  User  $manager
     * @param  PhoneNumber  $phone
     */
    public function __construct(User $user, User $manager, PhoneNumber $phone)
    {
        $this->user = $user;
        $this->phone = $phone;
        $this->manager = $manager;
    }

    public static function fromForm(Request $request, User $user)
    {
        $address = new PhoneNumber(
            $request->get('phone')
        );

        return new self($user, $request->user(), $address);
    }
}
