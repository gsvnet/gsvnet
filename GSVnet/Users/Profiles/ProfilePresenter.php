<?php namespace GSVnet\Users\Profiles;

use Laracasts\Presenter\Presenter, Carbon\Carbon, Gravatar, URL, Config;

class ProfilePresenter extends Presenter
{
    public function birthday()
    {
		$day = Carbon::createFromFormat('Y-m-d', $this->birthdate);
		$today = Carbon::today();

		if($day->format('m-d') == $today->format('m-d'))
		{
			return 'Vandaag';
		} else 
		{
    		return $day->formatLocalized('%e %B');	
		}
    }

    public function birthdayWithYear()
    {
        if( is_null( $this->birthdate ) )
        {
            return 'Op een dag';
        }

		$day = Carbon::createFromFormat('Y-m-d', $this->birthdate);
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
    	return $this->gender == 1 ? 'Man' : 'Vrouw';
    }

    public function xsmallProfileImage()
    {
        // Should return url
        // or img html with url generated
        if (  $this->photo_path != '')
        {
            $url = URL::action('MemberController@showPhoto', [  $this->user->profile->id, 'x-small']);
            return '<img src="' . $url . '" width="102" height="102" alt="Profielfoto">';
        }
        return Gravatar::image($this->user->email, 'Profielfoto', array('width' => 102, 'height' => 102));
    }

    public function photo()
    {
        // Should return url
        // or img html with url generated
        if (  $this->photo_path != '')
        {
            // what the fuck, $this->id geeft iets vaags
            // maar $this->user->profile->id geeft het goed,e terwijl this profile zou moeten zijn...
            $url = \URL::action('MemberController@showPhoto',   $this->user->profile->id);
            return '<img src="' . $url . '" width="120" height="120" alt="Profielfoto">';
        }
        return Gravatar::image($this->user->email, 'Profielfoto', array('width' => 120, 'height' => 120));
    }

    public function regionName()
    {
        $regions = Config::get('gsvnet.regions');
        
        if(array_key_exists(  $this->region, $regions))
        {
            return $regions[$this->region];    
        } else {
            return 'geen regio';
        }
    }

    public function student_number()
    {
        $nr =   $this->student_number;
        if( is_null($nr) || empty($nr) )
        {
            return 'Onbekend';
        }

        return $nr;
    }
}