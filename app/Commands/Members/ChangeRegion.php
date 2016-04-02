<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\Region;
use Illuminate\Http\Request;

class ChangeRegion extends Command
{

    /**
     * @var User
     */
    public $user;

    /**
     * @var Region
     */
    public $region;

    /**
     * @var user
     */
    public $manager;

    function __construct(User $user, User $manager, Region $region)
    {
        $this->user = $user;
        $this->region = $region;
        $this->manager = $manager;
    }

    static function fromForm(Request $request, User $user)
    {
        $region = new Region($request->get('region'));

        return new self($user, $request->user(), $region);
    }
}