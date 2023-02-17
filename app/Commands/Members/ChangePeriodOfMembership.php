<?php

namespace App\Commands\Members;

use App\Helpers\Users\User;
use App\Helpers\Users\ValueObjects\NullableDate;
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

    public function getInauguration(): NullableDate
    {
        return $this->inauguration;
    }

    public function getResignation(): NullableDate
    {
        return $this->resignation;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getManager(): User
    {
        return $this->manager;
    }
}
