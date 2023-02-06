<?php

namespace App\Commands\Members;

use App\Commands\Command;
use App\Helpers\Users\User;
use App\Helpers\Users\ValueObjects\OptionalAddress;
use App\Helpers\Users\ValueObjects\OptionalEmail;
use App\Helpers\Users\ValueObjects\OptionalPhoneNumber;
use Illuminate\Http\Request;

class ChangeParentsDetails extends Command
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var OptionalAddress
     */
    public $address;

    /**
     * @var OptionalPhoneNumber
     */
    public $phone;

    /**
     * @var OptionalEmail
     */
    public $email;

    /**
     * @var User
     */
    public $manager;

    public function __construct(User $user, User $manager, OptionalAddress $address, OptionalPhoneNumber $phone, OptionalEmail $email)
    {
        $this->user = $user;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->manager = $manager;
    }

    public static function fromForm(Request $request, User $user)
    {
        $address = new OptionalAddress(
            $request->get('parent_address'),
            $request->get('parent_zip_code'),
            $request->get('parent_town'),
            $request->get('parent_country')
        );

        $phone = new OptionalPhoneNumber(
            $request->get('parent_phone')
        );

        $email = new OptionalEmail(
            $request->get('parent_email')
        );

        return new self($user, $request->user(), $address, $phone, $email);
    }
}
