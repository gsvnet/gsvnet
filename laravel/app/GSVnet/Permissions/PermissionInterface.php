<?php namespace GSVnet\Permission;

interface PermissionInterface
{
    public function check(PermissionManager $manager);
}