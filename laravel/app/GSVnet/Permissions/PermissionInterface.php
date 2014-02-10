<?php namespace GSVnet\Permissions;

interface PermissionInterface
{
    public function check(PermissionManager $manager);
}