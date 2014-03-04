<?php namespace GSVnet\Users\Profiles;

use BasePresenter, Carbon\Carbon;

class ProfilePresenter extends BasePresenter
{
    public function __construct(UserProfile $profile)
    {
        $this->resource = $profile;
    }

    public function birthday()
    {
		$day = Carbon::createFromFormat('Y-m-d', $this->resource->birthdate);

    	return $day->formatLocalized('%e %B');
    }
}