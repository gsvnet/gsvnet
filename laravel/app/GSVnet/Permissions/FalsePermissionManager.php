<?php namespace GSVnet\Permissions;

/**
*   This manager returns false for all permissions.
*   It is used for testing.
*/
class FalsePermissionManager implements PermissionManagerInterface
{
    public function has($permission)
    {
        return false;
    }
}