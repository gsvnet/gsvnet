<?php namespace GSVnet\Permission;

/**
*   This manager returns false for all permissions.
*   It is used for testing.
*/
class FalsePermissionManager
{
    public function has($permission)
    {
        return false;
    }
}