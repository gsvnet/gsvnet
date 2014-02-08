<?php namespace GSVnet\Permission;

class PermissionManagerInterface
{
    public function has(PermissionInterface $permission);
}