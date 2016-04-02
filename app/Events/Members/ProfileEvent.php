<?php namespace GSV\Events\Members;

use Carbon\Carbon;
use GSVnet\Users\User;
use Illuminate\Queue\SerializesModels;

abstract class ProfileEvent
{
    use SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Carbon
     */
    protected $at;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->at = Carbon::now();
    }

    /**
     * @return Carbon
     */
    public function getAt()
    {
        return $this->at;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}