<?php namespace GSVnet\Permissions;
use Auth;

class UserPermissionManager implements PermissionManagerInterface
{
    // protected $user;

    // public function __construct(User $user)
    // {

    // }

    public function has($permission)
    {
        if (Auth::check())
            return true;
        return false;
    }
}