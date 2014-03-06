<?php namespace GSVnet\Users;

use BasePresenter, Carbon\Carbon, Config;

class UserPresenter extends BasePresenter
{
    public function __construct(User $user)
    {
        $this->resource = $user;
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
}