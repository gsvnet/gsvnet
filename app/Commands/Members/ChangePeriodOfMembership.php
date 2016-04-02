<?php namespace GSV\Commands\Members;

use Carbon\Carbon;
use GSVnet\Users\User;
use GSVnet\Users\ValueObjects\NullableDate;
use Illuminate\Http\Request;

class ChangePeriodOfMembership
{
    /**
     * @var NullableDate
     */
    private $inauguration;

    /**
     * @var NullableDate
     */
    private $resignation;
    
    /**
     * @var User
     */
    private $user;

    /**
     * @var User
     */
    private $manager;

    /**
     * ChangePeriodOfMembership constructor.
     * @param User $user
     * @param User $manager
     * @param NullableDate $inauguration
     * @param NullableDate $resignation
     */
    public function __construct(User $user, User $manager, NullableDate $inauguration, NullableDate $resignation)
    {
        $this->inauguration = $inauguration;
        $this->resignation = $resignation;
        $this->user = $user;
        $this->manager = $manager;
    }

    public static function fromForm(Request $request, User $user)
    {
        $inauguration = new NullableDate($request->get('inauguration_date') ?: null);
        $resignation = new NullableDate($request->get('resignation_date') ?: null);

        return new static($user, $request->user(), $inauguration, $resignation);
    }

    /**
     * @return NullableDate
     */
    public function getInauguration()
    {
        return $this->inauguration;
    }

    /**
     * @return NullableDate
     */
    public function getResignation()
    {
        return $this->resignation;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return User
     */
    public function getManager()
    {
        return $this->manager;
    }
}