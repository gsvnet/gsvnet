<?php namespace GSVnet\Users\Profiles;

use BasePresenter, Carbon\Carbon, Gravatar, URL, Config;

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
        if( is_null($this->resource->birthdate) )
        {
            return 'Op een dag';
        }

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
        if ($this->resource->photo_path != '')
        {
            $url = URL::action('MemberController@showPhoto', [$this->resource->user->profile->id, 'x-small']);
            return '<img src="' . $url . '" width="102" height="102" alt="Profielfoto">';
        }
        return Gravatar::image($this->user->email, 'Profielfoto', array('width' => 102, 'height' => 102));
    }

    public function photo()
    {
        // Should return url
        // or img html with url generated
        if ($this->resource->photo_path != '')
        {
            // what the fuck, $this->id geeft iets vaags
            // maar $this->user->profile->id geeft het goed,e terwijl this profile zou moeten zijn...
            $url = \URL::action('MemberController@showPhoto', $this->resource->user->profile->id);
            return '<img src="' . $url . '" width="120" height="120" alt="Profielfoto">';
        }
        return Gravatar::image($this->user->email, 'Profielfoto', array('width' => 120, 'height' => 120));
    }

    public function regionName()
    {
        $regions = Config::get('gsvnet.regions');
        
        if(array_key_exists($this->resource->region, $regions))
        {
            return $regions[$this->region];    
        } else {
            return 'geen regio';
        }
    }

    public function student_number()
    {
        $nr = $this->resource->student_number;
        if( is_null($nr) || empty($nr) )
        {
            return 'Onbekend';
        }

        return $nr;
    }
}