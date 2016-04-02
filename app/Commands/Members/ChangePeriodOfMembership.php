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
     * ChangePeriodOfMembership constructor.
     * @param User $user
     * @param NullableDate $inauguration
     * @param NullableDate $resignation
     */
    public function __construct(User $user, NullableDate $inauguration, NullableDate $resignation)
    {
        $this->inauguration = $inauguration;
        $this->resignation = $resignation;
        $this->user = $user;
    }

    public static function fromForm(Request $request, User $user)
    {
        $inauguration = new NullableDate($request->get('inauguration_date') ?: null);
        $resignation = new NullableDate($request->get('resignation_date') ?: null);

        return new static($user, $inauguration, $resignation);
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
}