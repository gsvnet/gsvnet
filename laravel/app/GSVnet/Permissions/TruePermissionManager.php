<?php namespace GSVnet\Permissions;

/**
*   This manager returns true for all permissions.
*   It is used for testing.
*/
class TruePermissionManager implements PermissionManagerInterface
{
    public function has($permission)
    {
        return true;
    }
}