<?php namespace GSVnet\Permissions;

interface PermissionManagerInterface
{
    public function has($permission);
}