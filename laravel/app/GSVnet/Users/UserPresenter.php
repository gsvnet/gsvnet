<?php namespace GSVnet\Users;

use Laracasts\Presenter\Presenter, Carbon\Carbon, Config, Gravatar, URL;

class UserPresenter extends Presenter
{

    public function fullName()
    {
        return $this->firstname . ' ' . $this->middlename . ' ' . $this->lastname;
    }

    public function senateFunction()
    {
        $functions = Config::get('gsvnet.senateFunctions');
        return $functions[$this->pivot->function];
    }

    public function registeredSince()
    {
        $from = \GSVnet\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);
    	return $from->diffForHumans();
    }

    public function membershipType()
    {
    	$string = '';
    	switch($this->type)
    	{
    		case 'visitor':
    			$string .= 'Gast';
			break;
    		case 'potential':
    			$string .= 'Noviet';
			break;
    		case 'member':
    			$string .= 'Lid';
			break;
    		case 'formerMember':
    			$string .= 'Oud-lid';
    			if(isset($this->profile))
    			{
    				$string .= $this->profile->reunist == 1 ? ' en reünist' : ', niet reünist';
    			}
			break;
			default:
				$string .= 'Onbekend';
			break;
    	}

    	return $string;
    }

    public function inCommiteeSince()
    {

        $since = Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->start_date);

        return $since->formatLocalized('%B %Y');
    }

    public function committeeFromTo()
    {
        $from = Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->start_date);

        $string = $from->formatLocalized("%Y");

        if( is_null($this->pivot->end_date) )
        {
            $string .= ' tot heden';
        } else
        {

            $to = Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->end_date);
            if($to->isFuture())
            {
                $string .= ' tot heden';
            }
            else 
            {
                $string .= ' tot ';
                $string .= $to->formatLocalized("%Y");
            }
        }
        return $string;
    }

    public function avatar($size = 120)
    {
        return Gravatar::image($this->email, 'Profielfoto', array('width' => $size, 'height' => $size));
    }

    public function profileUrl()
    {
        return URL::action('UserController@showUser', [$this->id]);
    }
}