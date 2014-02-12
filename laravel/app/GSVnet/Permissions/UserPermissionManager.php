<?php namespace GSVnet\Permissions;

class UserPermissionManager implements PermissionManagerInterface
{
    // protected $user;

    // public function __construct(User $user)
    // {

    // }

    public function has($permission)
    {
        return true;
    }
}