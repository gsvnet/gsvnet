<?php namespace GSV\Events\Members;

use GSVnet\Users\User;
use Illuminate\Queue\SerializesModels;

class YearGroupWasChanged extends ProfileEvent {

	use SerializesModels;

    public $user;

    public function __construct(User $user)
	{
        $this->user = $user;
    }
}
