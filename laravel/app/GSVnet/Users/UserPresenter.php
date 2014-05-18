<?php namespace GSVnet\Users;

use BasePresenter, Carbon\Carbon, Config, Gravatar, URL;

class UserPresenter extends BasePresenter
{
    public function __construct(User $user)
    {
        $this->resource = $user;
    }

    public function fullName()
    {
        return $this->resource->firstname . ' ' . $this->resource->middlename . ' ' . $this->resource->lastname;
    }

    public function senateFunction()
    {
        $functions = Config::get('gsvnet.senateFunctions');
        return $functions[$this->pivot->function];
    }

    public function registeredSince()
    {
        $from = \GSVnet\Carbon::createFromFormat('Y-m-d H:i:s', $this->resource->created_at);
    	return $from->diffForHumans();
    }

    public function membershipType()
    {
    	$string = '';
    	switch($this->resource->type)
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
    			if(isset($this->resource->profile))
    			{
    				$string .= $this->resource->profile->reunist == 1 ? ' en reünist' : ', niet reünist';
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

        $since = Carbon::createFromFormat('Y-m-d H:i:s', $this->resource->pivot->start_date);

        return $since->formatLocalized('%B %Y');
    }

    public function committeeFromTo()
    {
        $from = Carbon::createFromFormat('Y-m-d H:i:s', $this->resource->pivot->start_date);

        $string = $from->formatLocalized("%Y");

        if( is_null($this->resource->pivot->end_date) )
        {
            $string .= ' tot heden';
        } else
        {

            $to = Carbon::createFromFormat('Y-m-d H:i:s', $this->resource->pivot->end_date);
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
        return Gravatar::image($this->resource->email, 'Profielfoto', array('width' => $size, 'height' => $size));
    }

    public function profileUrl()
    {
        return URL::action('UserController@showUser', [$this->resource->id]);
    }
}