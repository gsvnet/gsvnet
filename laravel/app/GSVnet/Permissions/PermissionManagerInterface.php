<?php namespace GSVnet\Permission;

class PermissionManagerInterface
{
    // Store a collection of all current permissions
    protected $permissions;

    public function has(PermissionInterface $permission);
}