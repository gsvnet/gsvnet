<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\OptionalAddress;
use GSVnet\Users\ValueObjects\OptionalPhoneNumber;
use Illuminate\Http\Request;

class ChangeParentsDetails extends Command {

    /**
     * @var User
     */
    public $user;
    public $address;
    public $phone;

    function __construct(User $user, OptionalAddress $address, OptionalPhoneNumber $phone)
    {
        $this->user = $user;
        $this->address = $address;
        $this->phone = $phone;
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

        return new self($user, $address, $phone);
    }
}