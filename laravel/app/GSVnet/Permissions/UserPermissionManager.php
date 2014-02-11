<?php namespace GSVnet\Permission;

class UserPermissionManager
{
    protected $user;

    public function __construct(User $user)
    {

    }

    public function has($permission)
    {
        return true;
    }
}