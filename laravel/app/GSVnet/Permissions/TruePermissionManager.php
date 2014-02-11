<?php namespace GSVnet\Permission;

/**
*   This manager returns true for all permissions.
*   It is used for testing.
*/
class TruePermissionManager
{
    public function has($permission)
    {
        return true;
    }
}