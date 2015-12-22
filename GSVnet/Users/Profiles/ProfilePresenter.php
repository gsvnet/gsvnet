<?php namespace GSVnet\Users\Profiles;

use haampie\Gravatar\Gravatar;
use Laracasts\Presenter\Presenter;
use Carbon\Carbon;
use Config;
use URL;

class ProfilePresenter extends Presenter
{
    public function birthday()
    {
		$day = Carbon::createFromFormat('Y-m-d', $this->birthdate);
		$today = Carbon::today();

		if($day->format('m-d') == $today->format('m-d'))
			return 'Vandaag';
		else
    		return $day->formatLocalized('%e %B');	
	}

    public function birthdayWithYear()
    {
        if( is_null( $this->birthdate ) )
            return 'Op een dag';

		$day = Carbon::createFromFormat('Y-m-d', $this->birthdate);
		$today = Carbon::today();

		if($day->format('Y-m') == $today->format('Y-m'))
			return 'Vandaag';
		else
    		return $day->formatLocalized('%e %B %Y');
    }

    public function genderLocalized()
    {
    	return $this->gender === null ? 'Nee' : ($this->gender == 1 ? 'Man' : 'Vrouw');
    }

    public function xsmallProfileImage()
    {
        if ($this->photo_path != '')
            return action('MemberController@showPhoto', [$this->user->profile->id, 'x-small']);

        return Gravatar::image($this->user->email, 102, 'mm', null, null, true);
    }

    public function photo()
    {
        if ($this->photo_path != '')
            action('MemberController@showPhoto',   $this->user->profile->id);

        return Gravatar::image($this->user->email, 120, 'mm', null, null, true);
    }

    public function regionName()
    {
        $regions = Config::get('gsvnet.regions');
        
        if(array_key_exists($this->region, $regions))
            return $regions[$this->region];    

        else
            return 'geen regio';
    }

    public function student_number()
    {
        $nr = $this->student_number;

        if( is_null($nr) || empty($nr) )
            return 'Onbekend';

        return $nr;
    }

    public function resignationDateSimple()
    {
        if($this->resignation_date)
            return $this->resignation_date->format('d-m-Y');

        return '';
    }

    public function inaugurationDateSimple()
    {
        if($this->inauguration_date)
            return $this->inauguration_date->format('d-m-Y');

        return '';
    }
}