<?php namespace GSVnet\Users;

use Laracasts\Presenter\Presenter;
use Carbon\Carbon; 
use Config;
use URL;
use HTML;

class UserPresenter extends Presenter
{

    public function fullName()
    {
        $fullName = $this->firstname . ' ' . $this->middlename . ' ' . $this->lastname;

        if($fullName == '  ') {
            return 'onbekend';
        } else {
            return $fullName;
        }
    }

    public function fullLastname(){
        $middlename = $this->middlename;
        if(empty($middlename))
        {
            return $this->lastname;
        }
        else
        {
            return $this->middlename . ' ' . $this->lastname;
        }
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

    public function membershipType($showReunist = true)
    {
    	$string = '';
    	switch($this->type)
    	{
    		case User::VISITOR :
    			$string .= 'Gast';
			break;
    		case User::POTENTIAL :
    			$string .= 'Noviet';
			break;
    		case User::MEMBER:
    			$string .= 'Lid';
			break;
    		case User::FORMERMEMBER:
    			$string .= 'Oud-lid';
    			if($showReunist && isset($this->profile))
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
        $url = md5(strtolower(trim($this->email))) . '?s=' . $size;
        return HTML::image($url, 'Avatar', ['width' => $size, 'height' => $size]);
    }

    public function avatarDeferred($size = 120)
    {
        $url = md5(strtolower(trim($this->email))) . '?s=' . $size;
        return '<span class="img-wrap" data-gravatar-url="' . $url . '" data-gravatar-size="' . $size . '"></span>';
    }

    public function profileUrl()
    {
        return URL::action('UserController@showUser', [$this->id]);
    }
}