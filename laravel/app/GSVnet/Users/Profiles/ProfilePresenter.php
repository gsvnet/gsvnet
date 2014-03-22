<?php namespace GSVnet\Users\Profiles;

use BasePresenter, Carbon\Carbon, Gravatar, URL;

class ProfilePresenter extends BasePresenter
{
    public function __construct(UserProfile $profile)
    {
        $this->resource = $profile;
    }

    public function birthday()
    {
		$day = Carbon::createFromFormat('Y-m-d', $this->resource->birthdate);
		$today = Carbon::today();

		if($day->format('Y-m') == $today->format('Y-m'))
		{
			return 'Vandaag';
		} else 
		{
    		return $day->formatLocalized('%e %B');	
		}
    }

    public function birthdayWithYear()
    {
		$day = Carbon::createFromFormat('Y-m-d', $this->resource->birthdate);
		$today = Carbon::today();

		if($day->format('Y-m') == $today->format('Y-m'))
		{
			return 'Vandaag';
		} else 
		{
    		return $day->formatLocalized('%e %B %Y');	
		}
    }

    public function genderLocalized()
    {
    	$gender = $this->resource->gender;

    	return $gender == 'male' ? 'Man' : 'Vrouw';
    }

    public function xsmallProfileImage()
    {
        // Should return url
        // or img html with url generated
        if ($this->photo_path != '')
        {
            $url = URL::action('MemberController@showPhoto', [$this->resource->user->profile->id, 'x-small']);
            return '<img src="' . $url . '" width="102" height="102" alt="Profielfoto">';
        }
        return Gravatar::image($this->user->email, 'Profielfoto', array('width' => 102, 'height' => 102));
    }
}