<?php namespace GSVnet\Permissions;

interface PermissionManagerInterface
{
    // TODO: misschien PermissionInterface gebruiken?
    public function has($permission);
}