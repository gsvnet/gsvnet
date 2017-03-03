<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\OptionalAddress;
use GSVnet\Users\ValueObjects\OptionalPhoneNumber;
use GSVnet\Users\ValueObjects\OptionalEmail;
use Illuminate\Http\Request;

class ChangeParentsDetails extends Command {

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

    function __construct(User $user, User $manager, OptionalAddress $address, OptionalPhoneNumber $phone, OptionalEmail $email)
    {
        $this->user = $user;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->manager = $manager;
    }

    static function fromForm(Request $request, User $user)
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