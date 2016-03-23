<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\ValueObjects\Business;
use GSVnet\Users\User;
use Illuminate\Http\Request;

class ChangeBusiness extends Command {

    /**
     * @var User
     */
    public $user;
    public $business;

    function __construct(User $user, Business $business)
    {
        $this->user = $user;
        $this->business = $business;
    }

    static function fromForm(Request $request, User $user)
    {
        $business = new Business(
            $request->get('company'),
            $request->get('profession'),
            $request->get('business_url')
        );

        return new static($user, $business);
    }
}