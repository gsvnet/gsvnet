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
}